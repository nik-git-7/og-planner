<?php

namespace ogPlanner\dao;

use ogPlanner\model\IUserCourseTimetableConnector;


interface IUserCourseTimetableConnectorRepo
{
    public function findById(int $id): ?IUserCourseTimetableConnector;

    public function findByUserId(int $userId): array;

    public function findByCourse(string $course): array;

    public function findByTimetableId(int $timetableId): array;
}