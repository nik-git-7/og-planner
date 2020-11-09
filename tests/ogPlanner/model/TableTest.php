<?php

namespace ogPlanner\model;

use PHPUnit\Framework\TestCase;


class TableTest extends TestCase
{
    private ITable $table;
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

    public function testAddMultipleRows()
    {
        $this->table->addRows([
            ['05a', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['05b', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['03a', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['  ', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['asdf', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['13', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['14', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['-222', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['veryveryveryverylong', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['05a', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['05a', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['05a', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['05a', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['05a', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['05a', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['05a', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['05a', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    ']]);

        $this->assertEquals([
            ['05a', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['05b', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['03a', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['  ', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['asdf', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['13', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['14', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['-222', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['veryveryveryverylong', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['05a', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['05a', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['05a', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['05a', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['05a', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['05a', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['05a', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['05a', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    ']], $this->table->getAllRows());

    }

    public function testGetAllRows()
    {
        $this->assertEquals([], $this->table->getAllRows());
        $this->table->addRows([['foo', 'bar', 'baz', 'c', 'kiss', 'soc', 'mvc']]);
        $this->table->addRows([['spp', 'aer', 'css', 'eicb', 'moses', 'se', 'fop']]);
        $this->table->addRows([['-1', '-1', '-1', '-1', '-1', '-1', '-1']]);
        $this->assertEquals([
            ['foo', 'bar', 'baz', 'c', 'kiss', 'soc', 'mvc'],
            ['spp', 'aer', 'css', 'eicb', 'moses', 'se', 'fop'],
            ['-1', '-1', '-1', '-1', '-1', '-1', '-1']], $this->table->getAllRows());
    }

    public function testIsNotEmpty()
    {
        $this->table->addRows([['1', '2', '3', '4', '5', '6', '7']]);
        $this->assertEquals(false, $this->table->isEmpty());
    }

    public function testIsEmpty()
    {
        $this->assertEquals(true, $this->table->isEmpty());
    }

    public function testGetRowCount()
    {
        $this->assertEquals(0, $this->table->getRowCount());
        $this->table->addRows([['1', '2', '3', '4', '5', '6', '7']]);
        $this->assertEquals(1, $this->table->getRowCount());
        $this->table->addRows([['a', 'b', 'c', 'd', 'e', 'f', 'g']]);
        $this->assertEquals(2, $this->table->getRowCount());
        $this->table->addRows([['foo', 'bar', 'baz', 'c', 'kiss', 'soc', 'mvc']]);
        $this->table->addRows([['spp', 'aer', 'css', 'eicb', 'moses', 'se', 'fop']]);
        $this->table->addRows([['-1', '-1', '-1', '-1', '-1', '-1', '-1']]);
        $this->assertEquals(5, $this->table->getRowCount());
    }

    public function testGetRows()
    {
        $this->assertEquals([], $this->table->getRows('Pos', '1.'));
        $this->table->addRows([
            ['13', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['13', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['03a', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['  ', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['asdf', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['13', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    ']]);
        $this->assertEquals([
            ['13', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['13', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    '],
            ['13', '1.', '       ', 'BK', 'BKS1', 'Fällt aus', '    ']], $this->table->getRows('Klasse', '13'));
    }

    public function testGetColumnNames()
    {
        $this->assertEquals(['Klasse', 'Pos', 'Vertretername', 'Fach', 'Raum', 'Art', 'Mitteilung'], $this->table->getColumnNames());
    }
}
