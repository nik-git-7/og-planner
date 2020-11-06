<?php

require_once 'IScraper.php';


class TableScraper implements IScraper
{
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }
    
    public function scrape(): Table
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
        $headerNodes = $xpath->query('//table/thead/tr/th');
        $rowNodes = $xpath->query('//table/tbody/tr');
        var_dump($rowNodes);

        $headerColumns = [];
        /** @var DOMNode $headerNode */
        foreach ($headerNodes as $headerNode) {
            $headerColumns[] = prepareInput($headerNode->nodeValue);
        }
        print_r($headerColumns);

        $rows = [];
        /** @var DOMNode $rowNode */
        foreach ($rowNodes as $rowNode) {
            $row = [];
            $rowEntries = $xpath->query('./td', $rowNode);

            /** @var DOMNode $rowEntry */
            foreach ($rowEntries as $rowEntry) {
                $row[] = prepareInput($rowEntry->nodeValue);
            }

            $rows[] = $row;
        }
        print_r($rows);

        return new Table($headerColumns, $rows);
    }
}