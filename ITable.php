<?php


interface ITable
{
    public function addRows(array $rows): void;
    public function getRows(string $key, string $value): array;
}