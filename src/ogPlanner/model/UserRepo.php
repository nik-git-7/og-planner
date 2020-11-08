<?php /** @noinspection PhpIncompatibleReturnTypeInspection */

namespace ogPlanner\model;

use Doctrine\ORM\EntityRepository;

class UserRepo extends EntityRepository implements IUserRepo
{
    public function findUserById(int $id): ?User
    {
        return $this->find($id);
    }

    public function findUsersByName(string $username): array
    {
        return $this->findBy(['name' => $username]);
    }

    public function findUsersByEmail(string $email): array
    {
        return $this->findBy(['email' => $email]);
    }

    public function findUsersBySchoolClass(string $class): array
    {
        return $this->findBy(['class' => $class]);
    }
}