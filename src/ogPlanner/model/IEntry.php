<?php

namespace ogPlanner\model;

interface IEntry
{
    public function getClass();

    public function getLesson();

    public function getRepresentative();

    public function getSubject();

    public function getRoom();

    public function getKind();

    public function getNotification();
}