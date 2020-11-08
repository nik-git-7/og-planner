<?php


namespace ogPlanner\model;


interface IUserRepo
{
    public function findUserById(int $id): ?User;

    public function findUsersByName(string $username): array;

    public function findUsersByEmail(string $email): array;
}