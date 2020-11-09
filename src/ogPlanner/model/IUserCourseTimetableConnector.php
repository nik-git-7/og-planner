<?php

namespace ogPlanner\model;


interface IUserCourseTimetableConnector
{
    public function getConnection(): array;

    public function getTimetableId(): int;

    public function getCourse(): string;

    public function getUserId(): int;

    public function getId(): int;
}