<?php

namespace ogPlanner\model;


interface ILesson
{
    public function getId(): int;

    public function getTimetableId(): int;

    public function getDay(): int;

    public function getPosition(): int;

    public function getSubject(): string;
}