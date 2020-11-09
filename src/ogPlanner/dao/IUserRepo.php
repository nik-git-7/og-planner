<?php

namespace ogPlanner\dao;

use ogPlanner\model\User;


interface IUserRepo
{
    public function findById(int $id): ?User;

    public function findByName(string $username): array;

    public function findByEmail(string $email): array;

    public function findByNotificationId(int $id): array;
}