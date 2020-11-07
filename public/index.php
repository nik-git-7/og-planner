<?php

require_once 'config.php';
require_once 'doctrine-setup.php';
require_once '../src/ogPlanner/controller/util.php';

use ogPlanner\controller\OGMailer;
use ogPlanner\controller\TableScraper;
use ogPlanner\model\User;
use ogPlanner\model\UserRepository;


function main(): void
{
    $scraper = new TableScraper(PLANNER_URL);
    $table = $scraper->scrape();
    if ($table->isEmpty()) {
        return;
    }

    $map = tableToMap($table);

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
                logToFile('Could not send E-Mail to ' . $user->getName() . ' with E-Mail ' . $user->getEmail());
            }
        }
    }
}

main();
