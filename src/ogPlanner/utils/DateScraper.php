<?php

namespace ogPlanner\utils;

use DOMXPath;


class DateScraper extends AbstractScraper
{
    protected function parse(DOMXPath $xpath)
    {
        $planDateUnparsed = $xpath->query("//*[contains(@class, 'list-table-caption')]")[0]->nodeValue;
        $planUpdateUnparsed = $xpath->query("//*[contains(@class, 'col-xs-12')]")[2]->nodeValue;
        $planDate = trim($planDateUnparsed);
        $planUpdate = trim(explode('|', $planUpdateUnparsed)[0]);

        return ['plan_date' => $planDate, 'plan_update' => $planUpdate];

        // '[0-9][0-9]-[0-9][0-9]-[0-9][0-9][0-9][0-9] [0-9][0-9]:[0-9][0-9]'
    }
}