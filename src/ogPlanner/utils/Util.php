<?php


namespace ogPlanner\utils;

require_once BASEDIR . 'src/ogPlanner/model/IEntry.php';
require_once BASEDIR . 'src/ogPlanner/model/Entry.php';

use ogPlanner\model\Entry;


class Util
{
    public static function convertTableToMap($table): array
    {
        $map = [];

        foreach ($table->getAllRows() as $row) {
            $entry = new Entry($row[0], (int)$row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
            $map[$row[0]][] = $entry;
        }

        return $map;
    }

    public static function logToFile(string $logMessage): void
    {
        $file = fopen(LOG_FILE, 'a');
        fwrite($file, $logMessage . "\r\n\r\n");
        fclose($file);
    }

    /**
     * @param $string
     * @param $filename
     * @return bool true iff file changed, false otherwise
     */
    public static function updateFileContents($string, $filename): bool
    {
        if (file_get_contents($filename) == $string) {
            return false;
        }
        $file = fopen($filename, 'w');
        fwrite($file, $string);
        fclose($file);
        return true;
    }
}