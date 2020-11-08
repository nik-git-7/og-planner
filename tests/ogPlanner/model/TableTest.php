<?php

namespace ogPlanner\model;

use PHPUnit\Framework\TestCase;

class TableTest extends TestCase
{
    private Table $table;
    private array $headerNames;

    public function setUp(): void
    {
        $this->headerNames = ['Klasse', 'Pos', 'Vertretername', 'Fach', 'Raum', 'Art', 'Mitteilung'];
        $this->table = new Table(['Klasse', 'Pos', 'Vertretername', 'Fach', 'Raum', 'Art', 'Mitteilung']);
    }

    public function testAddSingleRow()
    {
        $this->table->addRows([
            ['05a', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    ']]);
        $this->assertEquals([['05a', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    ']], $this->table->getAllRows());
    }

    public function testAddRows()
    {

    }

    public function testGetAllRows()
    {

    }

    public function testIsEmpty()
    {
        $this->assertEquals(true, $this->table->isEmpty());
    }

    public function testGetRowCount()
    {
        $this->assertEquals(0, $this->table->getRowCount());
    }

    public function testGetRows()
    {

    }

    public function testGetColumnNames()
    {
        $this->assertEquals(['Klasse', 'Pos', 'Vertretername', 'Fach', 'Raum', 'Art', 'Mitteilung'], $this->table->getColumnNames());
    }
}
