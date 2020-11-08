<?php


namespace ogPlanner\dao;

require_once BASEDIR . 'src/ogPlanner/model/UserCourseTimetableConnector.php';

use ogPlanner\model\UserCourseTimetableConnector;

interface IUserCourseTimetableConnectorRepo
{
    public function findById(int $id): ?UserCourseTimetableConnector;

    public function findByUserId(int $id): array;

    public function findByCourse(string $course): array;

    public function findByTimetableId(int $id): array;
}