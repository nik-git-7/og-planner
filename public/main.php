<?php

require_once '../vendor/autoload.php';

use Doctrine\ORM\EntityManager;
use ogPlanner\dao\ILessonRepo;
use ogPlanner\dao\IUserCourseTimetableConnectorRepo;
use ogPlanner\dao\IUserRepo;
use ogPlanner\dao\LessonRepo;
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

class Main
{
    public static function withLogger(string $msg, $fun): void
    {
        $code = $fun();
        Util::logToFile(sprintf($msg, $code));
        echo sprintf($msg, $code);
    }

    public static function run(): array
    {
        // region scraping
        $ogScraper = new OGScraper(Config::PLANNER_URL);
        $ogScraperData = $ogScraper->scrape();


        if (!Util::updateFileContents($ogScraperData['plan_update'], Config::LAST_UPDATE)) {
            return [];
        }

        $tableScraper = new TableScraper(Config::PLANNER_URL);
        $table = $tableScraper->scrape();
        if ($table->isEmpty()) {
            return [];
        }

        // endregion

        $courseMap = Util::convertTableToMap($table);

        $dateParsed = date_parse($ogScraperData['plan_date']);
        $dateStr = "{$dateParsed['day']}.{$dateParsed['month']}.{$dateParsed['year']}";
        $planDayOfWeek = date('N', strtotime($dateStr)) - 1;

        $resultUserEntryDayMap = [];

        // region get user and connector repos
        $entityManager = Config::getEntityManager();
        $userRepo = $entityManager->getRepository(User::class);

        /** @var IUserCourseTimetableConnectorRepo $connectorRepo */
        $connectorRepo = $entityManager->getRepository(UserCourseTimetableConnector::class);

        /** @var ILessonRepo $lessonRepo */
        $lessonRepo = $entityManager->getRepository(Lesson::class);

        /** @var IUserRepo $userRepo */
        $users = $userRepo->findAll();

        // endregion

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
                $emailEntries = self::getEMailEntries($entries, $planDayOfWeek, $lessonRepo, $uctc);
            }

            if (count($emailEntries) == 0) {
                continue;
            }

            $resultUserEntryDayMap[] = ['user' => $user, 'email_entries' => $emailEntries,
                'plan_day_of_week' => $planDayOfWeek];

            /*if (OGMailer::sendEntryMail($user, $emailEntries, $planDayOfWeek)) {
                Util::logToFile('Successfully sent E-Mail to #' . $user->getId() . ' - ' . $user->getName() .
                    ' with E-Mail ' . $user->getEmail());
            } else {
                Util::logToFile('Could not send E-Mail to #' . $user->getId() . ' - ' . $user->getName() .
                    ' with E-Mail ' . $user->getEmail());
            }*/
        }

        return $resultUserEntryDayMap;
    }

    private static function getEMailEntries(array $entries, int $planDayOfWeek, ILessonRepo $lessonRepo,
                                            IUserCourseTimetableConnector $uctc): array
    {
        $emailEntries = [];

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
                        break;
                    }
                }
            }
        }
        return $emailEntries;
    }
}

/*Main::withLogger('Executed with Code: %d', function (): array {
    return Main::run();
});*/
