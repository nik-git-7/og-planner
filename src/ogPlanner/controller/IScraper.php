<?php

namespace ogPlanner\controller;

use ogPlanner\model\ITable;

interface IScraper
{
    public function scrape(): ITable;
}