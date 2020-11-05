<?php


class Scraper implements IScraper
{

    public function scrape(): ?array
    {
        // TODO: Implement scrape() method.
        $html = file_get_contents(PLANNER_URL); // allow_url_fopen must be set to true in php.ini; use curl instead

        $doc = new DOMDocument();
        $doc->loadHTML($html);

        foreach ($doc->childNodes as $item) {

        }

        return null;
    }
}