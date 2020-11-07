<?php

namespace ogPlanner\model;

interface IEntry
{
    public function getSchoolClass(): string;

    public function getLesson(): int;

    public function getRepresentative(): string;

    public function getSubject(): string;

    public function getRoom(): string;

    public function getKind(): string;

    public function getNotification(): string;
}