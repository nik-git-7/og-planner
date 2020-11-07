<?php


namespace ogPlanner\controller;

use ogPlanner\model\Entry;


class Util
{
    public static function tableToMap($table): array
    {
        $map = [];

        foreach ($table->getAllRows() as $row) {
            $entry = new Entry($row[0], (int)$row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
            $map[$row[0]][] = $entry;
        }

        return $map;
    }
}