<?php

require_once '../vendor/autoload.php';

use Doctrine\ORM\EntityManager;
use ogPlanner\dao\ILessonRepo;
use ogPlanner\dao\IUserCourseTimetableConnectorRepo;
use ogPlanner\dao\IUserRepo;
use ogPlanner\model\IEntry;
use ogPlanner\model\ILesson;
use ogPlanner\model\IUser;
use ogPlanner\model\IUserCourseTimetableConnector;
use ogPlanner\model\Lesson;
use ogPlanner\model\User;
use ogPlanner\model\UserCourseTimetableConnector;
use ogPlanner\utils\OGMailer;
use ogPlanner\utils\OGScraper;
use ogPlanner\utils\TableScraper;
use ogPlanner\utils\Util;


function withLogger(string $msg, $fun): void
{
    $code = $fun();
    Util::logToFile(sprintf($msg, $code));
    echo sprintf($msg, $code);
}

function main(): int
{
    /** @var EntityManager $entityManager */
    /** @var IUserCourseTimetableConnectorRepo $connectorRepo */
    /** @var ILessonRepo $lessonRepo */
    /** @var IUserRepo $userRepo */
    $entityManager = Config::getEntityManager();
    $userRepo = $entityManager->getRepository(User::class);
    $connectorRepo = $entityManager->getRepository(UserCourseTimetableConnector::class);
    $lessonRepo = $entityManager->getRepository(Lesson::class);
    $users = $userRepo->findAll();

    $tableScraper = new TableScraper(Config::PLANNER_URL);
    $table = $tableScraper->scrape();
    $ogScraper = new OGScraper(Config::PLANNER_URL);
    $ogScraperData = $ogScraper->scrape();

    $dateParsed = date_parse($ogScraperData['plan_date']);
    $dateStr = "{$dateParsed['day']}.{$dateParsed['month']}.{$dateParsed['year']}";
    $planDayOfWeek = date('N', strtotime($dateStr)) - 1;

    $courseMap = Util::convertTableToMap($table);

    /** @var IUser $user */
    foreach ($users as $user) {
        $emailEntries = [];
        $uctcs = $connectorRepo->findByUserId($user->getId());

        /** @var IUserCourseTimetableConnector $uctc */
        foreach ($uctcs as $uctc) {
            $course = $uctc->getCourse();
            if (!array_key_exists($course, $courseMap)) {
                continue;
            }

            $entries = $courseMap[$course];
            if ($uctc->getTimetableId() == 0) {    // User is not a student of Oberstufe
                $emailEntries = $entries;
            } else {    // User is a student of Oberstufe
                $dayLessons = $lessonRepo->findByTimetableIdAndDay($uctc->getTimetableId(), $planDayOfWeek);

                /** @var ILesson $dayLesson */
                foreach ($dayLessons as $dayLesson) {
                    /** @var IEntry $entry */
                    foreach ($entries as $entry) {
                        if ($dayLesson->getPosition() == $entry->getPosition() &&
                            $dayLesson->getSubject() == $entry->getSubject()) {
                            $emailEntries[] = $entry;
                        }
                    }
                }
            }
        }
        // lessons(id, timetableId, day, position, subject)

        if (count($emailEntries) == 0) {
            continue;
        }

        if (OGMailer::sendEntryMail($user, $emailEntries, $planDayOfWeek)) {
            Util::logToFile('Successfully sent E-Mail to #' . $user->getId() . ' - ' . $user->getName() .
                ' with E-Mail ' . $user->getEmail());
        } else {
            Util::logToFile('Could not send E-Mail to #' . $user->getId() . ' - ' . $user->getName() .
                ' with E-Mail ' . $user->getEmail());
        }
    }

    return Config::EXIT_SUCCESS;
}

withLogger('Executed with Code: %d', function (): int {
    return main();
});
