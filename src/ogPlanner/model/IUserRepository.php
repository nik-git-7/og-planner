<?php


namespace ogPlanner\model;


interface IUserRepository
{
    public function findUserById(int $id): ?User;

    public function findUserByName(string $username): ?User;

    public function findUserByEmail(string $email): ?User;

    public function findUsersBySchoolClass(string $class): ?array;
}