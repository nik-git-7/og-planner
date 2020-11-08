<?php

namespace ogPlanner\model;

use RuntimeException;

/**
 * Class TableException
 * @package ogPlanner\model
 * @ORM\Entity(repositoryClass="UserS
 */
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