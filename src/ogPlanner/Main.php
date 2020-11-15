<?php

namespace ogPlanner;

use Config;
use ogPlanner\dao\ILessonRepo;
use ogPlanner\dao\INotificationRepo;
use ogPlanner\dao\IUserCourseTimetableConnectorRepo;
use ogPlanner\dao\IUserRepo;
use ogPlanner\model\ITable;
use ogPlanner\model\IUser;
use ogPlanner\model\IUserCourseTimetableConnector;
use ogPlanner\utils\DateScraper;
use ogPlanner\utils\OGMailer;
use ogPlanner\utils\TableScraper;
use ogPlanner\utils\Util;


class Main
{
    private IUserRepo $userRepo;
    private IUserCourseTimetableConnectorRepo $connectorRepo;
    private ILessonRepo $lessonRepo;
    private INotificationRepo $notificationRepo;
    private string $scrapeUrl;

    /**
     * Main constructor.
     * @param string $scrapeUrl
     * @param IUserRepo $userRepo
     * @param IUserCourseTimetableConnectorRepo $connectorRepo
     * @param ILessonRepo $lessonRepo
     * @param INotificationRepo $notificationRepo
     */
    public function __construct(string $scrapeUrl, IUserRepo $userRepo,
                                IUserCourseTimetableConnectorRepo $connectorRepo, ILessonRepo $lessonRepo,
                                INotificationRepo $notificationRepo)
    {
        $this->userRepo = $userRepo;
        $this->connectorRepo = $connectorRepo;
        $this->lessonRepo = $lessonRepo;
        $this->scrapeUrl = $scrapeUrl;
        $this->notificationRepo = $notificationRepo;
    }

    public function run(): array
    {
        $dateScraper = new DateScraper(Config::PLANNER_URL);
        $dateScraperData = $dateScraper->scrape();
        /*        if (!Util::updateFileContents($dateScraperData['plan_update'], Config::LAST_UPDATE)) {
                    return [];
                }*/

        $tableScraper = new TableScraper(Config::PLANNER_URL);
        /** @var ITable $table */
        $table = $tableScraper->scrape();
        if ($table->isEmpty()) {
            return [];
        }

        $userEntryDayMap = $this->getUserEntryDayMap(Util::convertTableToMap($table), $dateScraperData['plan_date']);
        $this->sendMails($userEntryDayMap);
        return $userEntryDayMap;
    }

    public function getUserEntryDayMap($courseMap, $planDate): array
    {
        $resultUserEntryDayMap = [];
        $users = $this->userRepo->findAll();

        /** @var IUser $user */
        foreach ($users as $user) {
            $usersEmailEntries = [];
            $uctcs = $this->connectorRepo->findByUserId($user->getId());

            /** @var IUserCourseTimetableConnector $uctc */
            foreach ($uctcs as $uctc) {
                $course = $uctc->getCourse();
                if (!array_key_exists($course, $courseMap)) {
                    continue;
                }

                $entries = $courseMap[$course];
                $dayLessons = $this->lessonRepo->findByTimetableIdAndDay($uctc->getTimetableId(),
                    self::convertPlanDayToDayOfWeek($planDate));
                $uctcEmailEntries = $uctc->getTimetableId() == 0 ? $entries :
                    self::filterEmailEntries($entries, $dayLessons);
                $usersEmailEntries = array_merge($usersEmailEntries, $uctcEmailEntries);
            }


            $resultUserEntryDayMap[] = ['user' => $user, 'email_entries' => $usersEmailEntries,
                'plan_date' => $planDate];
        }
        var_dump($resultUserEntryDayMap);
        echo "\n\n\n";
        return $resultUserEntryDayMap;
    }

    public function sendMails(array $userEntryDayMap): void
    {
        foreach ($userEntryDayMap as $item) {
            self::sendMail($item);
        }
    }

    public function sendMail(array $item): void
    {
        /** @var IUser $user */
        $user = $item['user'];
        $usersNotificationId = $user->getNotificationId();
        $notification = $this->notificationRepo->findById($usersNotificationId);
        if (!$notification->isEmailEnabled()) {
            return;
        }
        if (OGMailer::sendEntryMail($user, $item['email_entries'], $item['plan_date'])) {
            Util::logToFile('Successfully sent E-Mail to #' . $user->getId() . ' - ' . $user->getName() .
                ' with E-Mail ' . $user->getEmail());
        } else {
            Util::logToFile('Could not send E-Mail to #' . $user->getId() . ' - ' . $user->getName() .
                ' with E-Mail ' . $user->getEmail());
        }
    }

    private function convertPlanDayToDayOfWeek(string $planDate): int
    {
        $dateParsed = date_parse($planDate);
        $dateStr = "{$dateParsed['day']}.{$dateParsed['month']}.{$dateParsed['year']}";
        return (int)date('N', strtotime($dateStr)) - 1;
    }

    private function filterEmailEntries($entries, $lessons): array
    {
        return array_filter($entries, $this->isRelevantEntry($lessons));
    }

    private function isRelevantEntry($lessons)
    {
        return function ($entry) use ($lessons) {
            return count(array_filter($lessons, $this->hasEqualFieldsTo($entry))) >= 1;
        };
    }

    private function hasEqualFieldsTo($entry)
    {
        return function ($lesson) use ($entry) {
            return $lesson->getPosition() == $entry->getPosition() &&
                $lesson->getSubject() == $entry->getSubject();
        };
    }
}
