<?php


namespace ogPlanner\model;


interface ITimetablesRepository
{
    public function getTimetables(): array;
}