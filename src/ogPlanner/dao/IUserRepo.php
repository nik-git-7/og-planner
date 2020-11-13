<?php

namespace ogPlanner\dao;

use ogPlanner\model\IUser;


interface IUserRepo
{
    public function findById(int $id): ?IUser;

    public function findByName(string $name): array;

    public function findByEmail(string $email): array;

    public function findByNotificationId(int $notificationId): array;

    public function findAll(): array;
}