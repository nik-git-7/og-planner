<?php

require_once 'config.php';
require_once 'doctrine-setup.php';

use ogPlanner\controller\OGMailer;
use ogPlanner\controller\TableScraper;
use ogPlanner\model\User;
use ogPlanner\model\UserRepository;
use ogPlanner\controller\Util;

require_once '../../../public/config.php';

function logToFile(string $logMessage): void
{
    $file = fopen(LOG_FILE, 'a');
    fwrite($file, $logMessage . "\r\n\r\n");
    fclose($file);
}



function main(): void
{
    $scraper = new TableScraper(PLANNER_URL);
    $table = $scraper->scrape();
    if ($table->isEmpty()) {
        return;
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
                logToFile('Could not send E-Mail to ' . $user->getName() . ' with E-Mail ' . $user->getEmail());
            }
        }
    }
}

main();
