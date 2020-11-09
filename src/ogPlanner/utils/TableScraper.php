<?php

namespace ogPlanner\utils;

use DOMNode;
use DOMXPath;
use ogPlanner\model\Table;


class TableScraper extends AbstractScraper
{

    protected function parse(DOMXPath $xpath)
    {
        $headerNodes = $xpath->query('//table/thead/tr/th');
        $rowNodes = $xpath->query('//table/tbody/tr');

        $headerColumns = [];
        /** @var DOMNode $headerNode */
        foreach ($headerNodes as $headerNode) {
            $headerColumns[] = self::prepareInput($headerNode->nodeValue);
        }

        $rows = [];
        /** @var DOMNode $rowNode */
        foreach ($rowNodes as $rowNode) {
            $row = [];
            $rowEntries = $xpath->query('./td', $rowNode);

            /** @var DOMNode $rowEntry */
            foreach ($rowEntries as $rowEntry) {
                $row[] = self::prepareInput($rowEntry->nodeValue);
            }

            $rows[] = $row;
        }

        return new Table($headerColumns, $rows);
    }

    private static function prepareInput(string $input): string
    {
        return htmlspecialchars(stripslashes(trim($input)));
    }
}