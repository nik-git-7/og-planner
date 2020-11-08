<?php


namespace ogPlanner\model;


interface IUserCourseTimetableConnectorRepo
{
    public function findConnectorById(int $id): ?UserCourseTimetableConnector;

    public function findConnectorsByUserId(int $id): array;

    public function findConnectorsByCourse(string $course): array;

    public function findConnectorsByTimetableId(int $id): array;
}