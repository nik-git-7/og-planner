<?php

namespace ogPlanner\utils;

require_once "../../../public/config.php";

use PHPUnit\Framework\TestCase;

class OGScraperTest extends TestCase
{

    private IScraper $ogScraper;

    public function setUp(): void
    {
        $this->ogScraper = new OGScraper(BASEDIR . "tests/res/planner_page_1.html");
    }

    public function testScrape()
    {
        $ogData = $this->ogScraper->scrape();
        
        $this->assertEquals('Montag 09.11.2020', $ogData['plan_date']);
        $this->assertEquals('06-11-2020 16:14', $ogData['plan_update']);
    }
}
