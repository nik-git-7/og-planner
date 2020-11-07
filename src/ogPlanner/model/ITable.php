<?php

namespace ogPlanner\model;

interface ITable
{
    public function addRows(array $rows): void;

    public function getRows(string $key, string $value): array;

    public function getAllRows(): array;

    public function getRowCount(): int;

    public function isEmpty(): bool; // Todo: default methods in PHP?
}