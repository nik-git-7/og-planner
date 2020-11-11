<?php

namespace ogPlanner\model;


interface IEntry
{
    public function getCourse(): string;

    public function getPosition(): int;

    public function getRepresentative(): string;

    public function getSubject(): string;

    public function getRoom(): string;

    public function getKind(): string;

    public function getNotification(): string;
}