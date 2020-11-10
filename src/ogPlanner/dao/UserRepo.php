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

    public function findByName(string $name): array
    {
        return $this->findBy(['name' => $name]);
    }

    public function findByEmail(string $email): array
    {
        return $this->findBy(['email' => $email]);
    }

    public function findByNotificationId(int $notificationId): array
    {
        return $this->findBy(['notificationId' => $notificationId]);
    }

    public function findAll(): array
    {
        return parent::findAll();
    }
}