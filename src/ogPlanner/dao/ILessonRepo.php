<?php

namespace ogPlanner\dao;

use ogPlanner\model\ILesson;


interface ILessonRepo
{
    public function findById(int $id): ?ILesson;

    public function findByTimetableId(int $id): array;

    public function findByDay(int $day): array;

    public function findByPosition(int $position): array;

    public function findBySubject(string $subject): array;

    public function findByTimetableIdAndDay(int $id, int $day): array;
}