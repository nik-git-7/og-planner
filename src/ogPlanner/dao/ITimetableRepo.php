<?php

namespace ogPlanner\dao;

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