<?php

require_once 'config.php';
require_once 'doctrine-setup.php';
require_once BASEDIR . 'src/ogPlanner/model/IEntry.php';
require_once BASEDIR . 'src/ogPlanner/model/Entry.php';
require_once BASEDIR . 'src/ogPlanner/model/User.php';
require_once BASEDIR . 'src/ogPlanner/model/IUserRepo.php';
require_once BASEDIR . 'src/ogPlanner/model/SimpleUserRepo.php';

require_once BASEDIR . 'src/ogPlanner/utils/Util.php';
require_once BASEDIR . 'src/ogPlanner/utils/OGMailer.php';
require_once BASEDIR . 'src/ogPlanner/utils/IScraper.php';
require_once BASEDIR . 'src/ogPlanner/utils/OGScraper.php';
require_once BASEDIR . 'src/ogPlanner/utils/TableScraper.php';

use Doctrine\ORM\EntityManager;
use ogPlanner\model\IEntry;
use ogPlanner\model\ITimetable;
use ogPlanner\model\ITimetableRepo;
use ogPlanner\model\IUserCourseTimetableConnector;
use ogPlanner\model\IUserCourseTimetableConnectorRepo;
use ogPlanner\model\IUserRepo;
use ogPlanner\model\User;
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
    $ogScraper = new OGScraper(PLANNER_URL);
    $ogScraperData = $ogScraper->scrape();

    if (!Util::updateFileContents($ogScraperData['plan_update'], LAST_UPDATE)) {
//        return 2;
    }

    // Get table containing entries from website
    $tableScraper = new TableScraper(PLANNER_URL);
    $table = $tableScraper->scrape();
    if ($table->isEmpty()) {
        return 3;
    }

    $map = Util::convertTableToMap($table); // map[course][entries]

    /** @var EntityManager $entityManager */
    /** @var IUserCourseTimetableConnectorRepo $connectorRepo */
    /** @var IUserRepo $userRepo */
    $entityManager = getEntityManager();
    $connectorRepo = $entityManager->getRepository('UserCourseTimetableConnector');
    $userRepo = $entityManager->getRepository('User');

    foreach ($map as $course => $entries) {
        if (!count($entries)) {
            continue;
        }
        $relevantEntries = [];

        $connectors = $connectorRepo->findConnectorsByCourse($course);

        $users = [];
        /** @var IUserCourseTimetableConnector $connector */
        foreach ($connectors as $connector) {
            $timetableId = $connector->getTimetableId();

            if ($timetableId == null) { // There is no timetable, user must be a student in Unterstufe or Mittelstufe
                $relevantEntries = $entries;
            } else { // There is a timetable, user must be a student in Oberstufe
                /** @var ITimetableRepo $timetableRepo */
                /** @var ITimetable $timetables */
                $timetableRepo = $entityManager->getRepository('Timetable');
                $timetables = $timetableRepo->findTimetablesByTimetableIdAndDay($timetableId);

                if ($timetables == null) {
                    Util::logToFile('Error 7348754362871365831139: timetables should never be null here!');
                    continue;
                }

                /** @var ITimetable $timetable */
                foreach ($timetables as $timetable) {
                    if ($timetable->getDay() != $ogScraperData['plan_date']) {  // Tag der Vertretung
                        continue;
                    }

                    // Wie sehen hier $entries aus?
                    /** @var IEntry $entry */
                    foreach ($entries as $entry) {
                        if ($timetables->getLesson() == $entry->getLesson() &&
                            $timetables->getSubject() == $entry->getSubject()) {    // Vertretung!
                            $relevantEntries[] = $entry;
                        }
                    }
                }
            }

            $users[] = $userRepo->findUserById($connector->getUserId()); // Füge Schüler zur E-Mail hinzu!
        }

        if ($users == []) {
            continue;
        }

        /** @var User $user */
        foreach ($users as $user) { // Todo: Obersufenschüler müssen nicht zu allen Entries Vertretung haben! man muss die Entries noch filtern! Relevant entries
            if (!OGMailer::sendEntryMail($user, $relevantEntries, $ogScraperData['plan_date'])) {
                Util::logToFile('Could not send E-Mail to #' . $user->getId() . ' - ' . $user->getName() .
                    ' with E-Mail ' . $user->getEmail());
            }
        }
    }

    return EXIT_SUCCESS;
}

withLogger('Executed with Code: %d', function (): int {
    return main();
});
