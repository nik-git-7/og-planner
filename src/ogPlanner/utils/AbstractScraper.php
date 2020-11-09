<?php

namespace ogPlanner\utils;

use DOMDocument;
use DOMXPath;


abstract class AbstractScraper
{
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function scrape()
    {
        $html = file_get_contents($this->url); // allow_url_fopen must be set to true in php.ini; use curl instead
        $html = str_replace('aside', 'div', $html);
        $html = str_replace('footer', 'div', $html);
        $html = str_replace('nav', 'div', $html);

        $doc = new DOMDocument();
        $doc->loadHTML($html);
        $xpath = new DOMXPath($doc);

        return $this->parse($xpath);
    }

    protected abstract function parse(DOMXPath $xpath);
}