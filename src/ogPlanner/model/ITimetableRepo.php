<?php


namespace ogPlanner\model;


interface ITimetableRepo
{
    public function findTimetableById(int $id): ?ITimetable;

    public function findTimetablesByTimetableId(int $id): array;

    public function findTimetablesByDay(int $day): array;

    public function findTimetablesByLesson(int $lesson): array;

    public function findTimetablesBySubject(string $subject): array;
}