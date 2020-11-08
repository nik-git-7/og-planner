<?php


namespace ogPlanner\model;


interface IUserRepo
{
    public function findById(int $id): ?User;

    public function findByName(string $username): array;

    public function findByEmail(string $email): array;
}