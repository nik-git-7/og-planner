<?php

namespace ogPlanner\model;


interface ITimetable
{
    public function getId(): int;

    public function getTimetableId(): int;

    public function getDay(): int;

    public function getLesson(): int;

    public function getSubject(): string;
}