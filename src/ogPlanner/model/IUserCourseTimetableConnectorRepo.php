<?php


namespace ogPlanner\model;


interface IUserCourseTimetableConnectorRepo
{
    public function findConnectorById(int $id): ?UserCourseTimetableConnector;
}