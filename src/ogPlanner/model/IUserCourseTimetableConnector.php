<?php


namespace ogPlanner\model;


interface IUserCourseTimetableConnector
{
    public function getConnection(): array;
}