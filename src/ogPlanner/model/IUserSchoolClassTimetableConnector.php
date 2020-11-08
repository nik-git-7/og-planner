<?php


namespace ogPlanner\model;


interface IUserSchoolClassTimetableConnector
{
    public function getConnections(): array;
}