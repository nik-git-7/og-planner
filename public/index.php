<?php

require_once 'config.php';
require_once 'doctrine-setup.php';

use ogPlanner\model\OGMailer;
use ogPlanner\model\OGScraper;
use ogPlanner\model\TableScraper;
use ogPlanner\model\User;
use ogPlanner\model\UserRepository;
use ogPlanner\model\Util;

require_once '../../../public/config.php';


function withLogger($fun): void
{
    $code = $fun();
    Util::logToFile('Executed with Code: ' . $code);
}

function main(): int
{
    $ogScraper = new OGScraper(PLANNER_URL);
    $ogScraperData = $ogScraper->scrape();

    if (!Util::updateFileContents($ogScraperData['plan_update'], LAST_UPDATE)) {
        return 2;
    }

    $scraper = new TableScraper(PLANNER_URL);
    $table = $scraper->scrape();
    if ($table->isEmpty()) {
        return 3;
    }

    $map = Util::tableToMap($table);

    /** @var UserRepository $repo */
    $repo = getEntityManager()->getRepository('User');
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

withLogger(function() {main();});