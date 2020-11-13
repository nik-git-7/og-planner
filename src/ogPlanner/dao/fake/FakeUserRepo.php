<?php /** @noinspection PhpIncompatibleReturnTypeInspection */

namespace ogPlanner\dao\fake;

use ogPlanner\dao\IUserRepo;
use ogPlanner\model\IUser;


class FakeUserRepo extends FakeRepo implements IUserRepo
{
    public function __construct($db)
    {
        parent::__construct($db);
    }

    public function findById(int $id): ?IUser
    {
        $field = function(IUser $user) {return $user->getId();};
        return $this->searchOne($field, $id);
    }

    public function findByName(string $name): array
    {
        $field = function(IUser $user) {return $user->getName();};
        return $this->searchMulti($field, $name);
    }

    public function findByEmail(string $email): array
    {
        $field = function(IUser $user) {return $user->getEmail();};
        return $this->searchMulti($field, $email);
    }

    public function findByNotificationId(int $notificationId): array
    {
        $field = function(IUser $user) {return $user->getNotificationId();};
        return $this->searchMulti($field, $notificationId);
    }

    public function findAll(): array
    {
        return $this->db;
    }
}