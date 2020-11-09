<?php

namespace ogPlanner\utils;

require_once "../../../config/config.php";
require_once BASEDIR . "src/ogPlanner/utils/TableScraper.php";
require_once BASEDIR . 'src/ogPlanner/model/ITable.php';

use ogPlanner\model\ITable;
use PHPUnit\Framework\TestCase;

class TableScraperTest extends TestCase
{

    private ITable $table;

    public function setUp(): void
    {
        $tableScraper = new TableScraper(BASEDIR . "tests/res/planner_page_1.html");
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
