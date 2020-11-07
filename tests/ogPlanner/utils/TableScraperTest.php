<?php

namespace ogPlanner\utils;

use PHPUnit\Framework\TestCase;

class TableScraperTest extends TestCase
{

    private IScraper $tableScraper;

    public function setUp(): void
    {
        $this->tableScraper = new TableScraper("../res/planner_page_1.html");
    }

    public function testScrape()
    {
        $table = $this->tableScraper->scrape();
        $this->assertEquals(['Klasse', 'Pos', 'Vertretername', 'Fach', 'Raum', 'Art', 'Mitteilung'], $table->getColumnNames());
    }

    public function testNotUpdated()
    {
        echo __DIR__;
    }
}
