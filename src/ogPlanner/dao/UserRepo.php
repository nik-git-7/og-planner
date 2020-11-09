<?php /** @noinspection PhpIncompatibleReturnTypeInspection */

namespace ogPlanner\dao;

use Doctrine\ORM\EntityRepository;
use ogPlanner\model\User;


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

    public function findByNotificationId(int $id): array
    {
        return $this->findBy(['notificationId' => $id]);
    }
}