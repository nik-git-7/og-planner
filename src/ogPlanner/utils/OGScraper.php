<?php


namespace ogPlanner\utils;


use DOMDocument;
use DOMXPath;

class OGScraper implements IScraper
{

    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function scrape(): array
    {
        function prepareInput(string $input): string
        {
            return htmlspecialchars(stripslashes(trim($input)));
        }

        // Todo: Error handling
        $html = file_get_contents($this->url); // allow_url_fopen must be set to true in php.ini; use curl instead

        $doc = new DOMDocument();
        $doc->loadHTML($html);
        $xpath = new DOMXPath($doc);
        $planDate = $xpath->query("//*[contains(@class, 'list-table-caption')]")[0]->nodeValue;
        $planUpdateUnparsed = $xpath->query("//*[contains(@class, 'col-xs-12')]")[2]->nodeValue;
        $planUpdate = trim(explode('|', $planUpdateUnparsed)[0]);

        return ['plan_date' => $planDate, 'plan_update' => $planUpdate];
        // '[0-9][0-9]-[0-9][0-9]-[0-9][0-9][0-9][0-9] [0-9][0-9]:[0-9][0-9]'
    }
}