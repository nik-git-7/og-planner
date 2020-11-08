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

        $connectors = $connectorRepo->findConnectorsByCourse($course);

        $users = [];
        /** @var IUserCourseTimetableConnector $connector */
        foreach ($connectors as $connector) {
            if ($connector->getTimetableId() == null) { // There is no timetable, user must be a student in Unterstufe or Mittelstufe
                $users[] = $userRepo->findUserById($connector->getUserId());
            } else { // There is a timetable, user must be a student in Oberstufe
                // TODO
                // $entry->getSubject() ==
            }
        }

        if ($users == []) {
            continue;
        }

        /** @var User $user */
        foreach ($users as $user) {
            if (!OGMailer::sendEntryMail($user, $entries, $ogScraperData['plan_date'])) {
                Util::logToFile('Could not send E-Mail to #' . $user->getId() . ' - ' . $user->getName() .
                    ' with E-Mail ' . $user->getEmail());
            }
        }
    }

    return EXIT_SUCCESS;
}

withLogger('Executed with Code: %d', function(): int {return main();});
