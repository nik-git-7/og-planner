<?php

namespace ogPlanner\utils;

use Config;
use PHPUnit\Framework\TestCase;


class OGScraperTest extends TestCase
{

    private AbstractScraper $ogScraper;

    public function setUp(): void
    {
        $this->ogScraper = new DateScraper(Config::BASEDIR . "tests/res/planner_page_1.html");
    }

    public function testScrape()
    {
        $ogData = $this->ogScraper->scrape();
        
        $this->assertEquals('Montag 09.11.2020', $ogData['plan_date']);
        $this->assertEquals('06-11-2020 16:14', $ogData['plan_update']);
    }
}
