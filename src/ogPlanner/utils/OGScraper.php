<?php


namespace ogPlanner\utils;


use DOMDocument;
use DOMXPath;

class OGScraper extends AbstractScraper
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
        $html = str_replace('aside', 'div', $html);
        $html = str_replace('footer', 'div', $html);
        $html = str_replace('nav', 'div', $html);

        $doc = new DOMDocument();
        $doc->loadHTML($html);
        $xpath = new DOMXPath($doc);
        $planDateUnparsed = $xpath->query("//*[contains(@class, 'list-table-caption')]")[0]->nodeValue;
        $planUpdateUnparsed = $xpath->query("//*[contains(@class, 'col-xs-12')]")[2]->nodeValue;
        $planDate = trim($planDateUnparsed);
        $planUpdate = trim(explode('|', $planUpdateUnparsed)[0]);

        return ['plan_date' => $planDate, 'plan_update' => $planUpdate];
        // '[0-9][0-9]-[0-9][0-9]-[0-9][0-9][0-9][0-9] [0-9][0-9]:[0-9][0-9]'
    }
}