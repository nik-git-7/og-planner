<?php


namespace ogPlanner\model;

require_once 'IUserCourseTimetableConnector.php';


class SimpleUserCourseTimetableConnector implements IUserCourseTimetableConnector
{
    private array $connections;

    public function __construct()
    {
        $this->connections = [
            ['user_id' => 1, 'school_class' => '05a', null],
            ['user_id' => 1, 'school_class' => '05b', null],
            ['user_id' => 1, 'school_class' => '13'],
            ['user_id' => 2, 'school_class' => '13'],
            ['user_id' => 3, 'school_class' => '13'],
        ];
    }

    public function getConnection(): array
    {
        return $this->connections;
    }
}