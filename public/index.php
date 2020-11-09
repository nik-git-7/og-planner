<?php

require_once '../vendor/autoload.php';

use Doctrine\ORM\EntityManager;
use ogPlanner\dao\ILessonRepo;
use ogPlanner\dao\IUserCourseTimetableConnectorRepo;
use ogPlanner\dao\IUserRepo;
use ogPlanner\model\IEntry;
use ogPlanner\model\ILesson;
use ogPlanner\model\IUserCourseTimetableConnector;
use ogPlanner\model\Lesson;
use ogPlanner\model\User;
use ogPlanner\model\UserCourseTimetableConnector;
use ogPlanner\utils\OGMailer;
use ogPlanner\utils\OGScraper;
use ogPlanner\utils\TableScraper;
use ogPlanner\utils\Util;


function withLogger($msg, $fun): void
{
    $code = $fun();
    Util::logToFile(sprintf($msg, $code));
    echo sprintf($msg, $code);
}

function main(): int
{
    $ogScraper = new OGScraper(Config::PLANNER_URL);
    $ogScraperData = $ogScraper->scrape();

    if (!Util::updateFileContents($ogScraperData['plan_update'], Config::LAST_UPDATE)) {
//        return 2;
    }

    // Get table containing entries from website
    $tableScraper = new TableScraper(Config::PLANNER_URL);
    $table = $tableScraper->scrape();
    if ($table->isEmpty()) {
        return 3;
    }

    $map = Util::convertTableToMap($table); // map[course][entries]

    /** @var EntityManager $entityManager */
    /** @var IUserCourseTimetableConnectorRepo $connectorRepo */
    /** @var IUserRepo $userRepo */
    $entityManager = Config::getEntityManager();
    $connectorRepo = $entityManager->getRepository(UserCourseTimetableConnector::class);
    $userRepo = $entityManager->getRepository(User::class);

    foreach ($map as $course => $entries) {
        if (count($entries) == 0) {
            continue;
        }
        $relevantEntries = [];

        $connectors = $connectorRepo->findByCourse($course);

        $emailUsers = [];
        /** @var IUserCourseTimetableConnector $connector */
        foreach ($connectors as $connector) {
            $timetableId = $connector->getTimetableId();

            if ($timetableId == 0) { // There is no timetable, user must be a student in Unterstufe or Mittelstufe
                $relevantEntries = $entries;
            } else { // There is a timetable, user must be a student in Oberstufe
                /** @var ILessonRepo $timetableRepo */
                $timetableRepo = $entityManager->getRepository(Lesson::class);
                $dateParsed = date_parse($ogScraperData['plan_date']);
                $dateStr = "{$dateParsed['day']}.{$dateParsed['month']}.{$dateParsed['year']}";
                $dayOfWeek = date('N', strtotime($dateStr)) - 1;
                $dayTimetables = $timetableRepo->findByTimetableIdAndDay($timetableId, $dayOfWeek);       // Only get timetables with matching date

                if ($dayTimetables == null) {
                    continue;
                }

                /** @var ILesson $dayTimetable */
                foreach ($dayTimetables as $dayTimetable) {
                    // Wie sehen hier $entries aus?
                    /** @var IEntry $entry */
                    foreach ($entries as $entry) {
                        if ($dayTimetable->getPosition() == $entry->getPosition() &&
                            $dayTimetable->getSubject() == $entry->getSubject()) {    // Vertretung!
                            $relevantEntries[] = $entry;
                        }
                    }
                }
            }

            $emailUsers[] = $userRepo->findById($connector->getUserId()); // Füge Schüler zur E-Mail hinzu!
        }

        if ($emailUsers == []) {
            continue;
        }

        /** @var User $user */
        foreach ($emailUsers as $user) { // Todo: Obersufenschüler müssen nicht zu allen Entries Vertretung haben! man muss die Entries noch filtern! Relevant entries
            if (OGMailer::sendEntryMail($user, $relevantEntries, $ogScraperData['plan_date'])) {
                Util::logToFile('Successfully sent E-Mail to #' . $user->getId() . ' - ' . $user->getName() .
                    ' with E-Mail ' . $user->getEmail() . ' for course ' . $course);
            } else {
                Util::logToFile('Could not send E-Mail to #' . $user->getId() . ' - ' . $user->getName() .
                    ' with E-Mail ' . $user->getEmail() . ' for course ' . $course);
            }
        }
    }

    return Config::EXIT_SUCCESS;
}

withLogger('Executed with Code: %d', function (): int {
    return main();
});
