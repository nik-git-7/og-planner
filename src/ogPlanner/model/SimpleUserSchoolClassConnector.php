<?php


namespace ogPlanner\model;

require_once 'IUserSchoolClassConnector.php';


class SimpleUserSchoolClassConnector implements IUserSchoolClassConnector
{
    private array $connections;

    public function __construct()
    {
        $this->connections = [
            ['user_id' => 1, 'school_class' => '05a'],
            ['user_id' => 1, 'school_class' => '05b'],
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