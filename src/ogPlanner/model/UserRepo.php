<?php /** @noinspection PhpIncompatibleReturnTypeInspection */

namespace ogPlanner\model;

use Doctrine\ORM\EntityRepository;

class UserRepo extends EntityRepository implements IUserRepo
{
    public function findById(int $id): ?User
    {
        return $this->find($id);
    }

    public function findByName(string $username): array
    {
        return $this->findBy(['name' => $username]);
    }

    public function findByEmail(string $email): array
    {
        return $this->findBy(['email' => $email]);
    }
}