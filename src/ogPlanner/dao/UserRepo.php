<?php /** @noinspection PhpIncompatibleReturnTypeInspection */

namespace ogPlanner\dao;

use Doctrine\ORM\EntityRepository;
use ogPlanner\model\IUser;


class UserRepo extends EntityRepository implements IUserRepo
{
    public function findById(int $id): ?IUser
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