<?php


namespace ogPlanner\dao;

require_once BASEDIR . 'src/ogPlanner/model/User.php';

use ogPlanner\model\User;

interface IUserRepo
{
    public function findById(int $id): ?User;

    public function findByName(string $username): array;

    public function findByEmail(string $email): array;
}