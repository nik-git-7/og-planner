<?php

namespace ogPlanner\controller;

use RuntimeException;

class TableException extends RuntimeException
{
    /**
     * TableException constructor.
     * @param string $string
     */
    public function __construct(string $string)
    {
        parent::__construct($string);
    }
}