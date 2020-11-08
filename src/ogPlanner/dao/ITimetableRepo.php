<?php


namespace ogPlanner\dao;

require_once BASEDIR . 'src/ogPlanner/model/ITimetable.php';

use ogPlanner\model\ITimetable;

interface ITimetableRepo
{
    public function findById(int $id): ?ITimetable;

    public function findByTimetableId(int $id): array;

    public function findByDay(int $day): array;

    public function findByLesson(int $lesson): array;

    public function findBySubject(string $subject): array;

    public function findByTimetableIdAndDay(int $id, int $day): array;
}