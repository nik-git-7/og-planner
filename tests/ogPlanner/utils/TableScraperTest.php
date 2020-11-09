<?php

namespace ogPlanner\utils;

use Config;
use ogPlanner\model\ITable;
use PHPUnit\Framework\TestCase;


class TableScraperTest extends TestCase
{

    private ITable $table;

    public function setUp(): void
    {
        $tableScraper = new TableScraper(Config::BASEDIR . "tests/res/planner_page_1.html");
        $this->table = $tableScraper->scrape();
    }

    public function testHeader()
    {
        $this->assertEquals(['Klasse', 'Pos', 'Vertretername', 'Fach', 'Raum', 'Art', 'Mitteilung'],
            $this->table->getColumnNames());
    }

    public function testFirstCell()
    {
        $this->assertEquals('05a', $this->table->getAllRows()[0][0]);
    }
}
