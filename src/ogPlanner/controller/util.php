<?php

require_once '../../../public/config.php';

use ogPlanner\model\Entry;

function tableToMap($table): array
{
    $map = [];

    foreach ($table->getAllRows() as $row) {
        $entry = new Entry($row[0], (int)$row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
        $map[$row[0]][] = $entry;
    }

    return $map;
}

function logToFile(string $logMessage): void
{
    $file = fopen(LOG_FILE, 'a');
    fwrite($file, $logMessage . "\r\n\r\n");
    fclose($file);
}
