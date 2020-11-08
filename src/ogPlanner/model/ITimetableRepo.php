<?php


namespace ogPlanner\model;


interface ITimetableRepo
{
    public function getTimetables(): array;
}