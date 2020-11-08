<?php


namespace ogPlanner\model;


interface IUserCourseTimetableConnectorRepo
{
    public function findById(int $id): ?UserCourseTimetableConnector;

    public function findByUserId(int $id): array;

    public function findByCourse(string $course): array;

    public function findByTimetableId(int $id): array;
}