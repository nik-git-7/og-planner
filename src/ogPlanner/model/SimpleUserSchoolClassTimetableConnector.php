<?php


namespace ogPlanner\model;

require_once 'IUserSchoolClassTimetableConnector.php';


class SimpleUserSchoolClassTimetableConnector implements IUserSchoolClassTimetableConnector
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

    public function getConnections(): array
    {
        return $this->connections;
    }
}