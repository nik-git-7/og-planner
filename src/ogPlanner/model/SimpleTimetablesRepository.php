<?php


namespace ogPlanner\model;

require_once 'ITimetablesRepository.php';

class SimpleTimetablesRepository implements ITimetablesRepository
{
    private $timetables;

    /**
     * SimpleTimetablesRepository constructor.
     */
    public function __construct()
    {
        $this->timetables = [
            '11' => [

            ],

            '12' => [

            ],

            '13' => [
                'monday_1' => 'en1',
                'monday_2' => 'en2',
                'monday_'
            ]
        ];
    }

    public function getTimetables(): array
    {
        return $this->timetables;
    }
}