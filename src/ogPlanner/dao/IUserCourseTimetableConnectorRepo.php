<?php

namespace ogPlanner\dao;

use ogPlanner\model\UserCourseTimetableConnector;


interface IUserCourseTimetableConnectorRepo
{
    public function findById(int $id): ?UserCourseTimetableConnector;

    public function findByUserId(int $userId): array;

    public function findByCourse(string $course): array;

    public function findByTimetableId(int $timetableId): array;
}