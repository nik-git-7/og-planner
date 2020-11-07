<?php /** @noinspection PhpIncompatibleReturnTypeInspection */

namespace ogPlanner\model;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findUserById(int $id): ?User
    {
        return $this->find($id);
    }

    public function findUserByName(string $username): ?User
    {
        return $this->findOneBy(['name' => $username]);
    }

    public function findUserByEmail(string $email): ?User
    {
        return $this->findOneBy(['email' => $email]);
    }

    public function findUsersByClass($class): ?array
    {
        return $this->findBy(['class' => $class]);
    }
}