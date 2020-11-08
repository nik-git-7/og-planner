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

use ogPlanner\model\IUserRepo;
use ogPlanner\model\SimpleUserRepo;
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

    $scraper = new TableScraper(PLANNER_URL);
    $table = $scraper->scrape();
    if ($table->isEmpty()) {
        return 3;
    }

    $map = Util::convertTableToMap($table);

    /** @var IUserRepo $repo */
//    $repo = getEntityManager()->getRepository('User');
    $repo = new SimpleUserRepo();
    foreach ($map as $schoolClass => $entries) {
        if (!count($entries)) {
            continue;
        }

        $users = $repo->findUsersBySchoolClass($schoolClass);

        if ($users == null) {
            continue;
        }

        /** @var User $user */
        foreach ($users as $user) {
            if (!OGMailer::sendEntryMail($user, $entries)) {
                Util::logToFile('Could not send E-Mail to #' . $user->getId() . ' - ' . $user->getName() .
                    ' with E-Mail ' . $user->getEmail());
            }
        }
    }

    return EXIT_SUCCESS;
}

withLogger('Executed with Code: %d', function(): int {return main();});
