<?php


namespace ogPlanner\model;


class SimpleUserRepository implements IUserRepository
{
    private array $users;
    private array $userSchoolClasses;

    public function __construct()
    {
        $this->users = [
            new User(1, 'haha@miregal.de', 'Nik'),
        ];

        $this->userSchoolClasses = [
            '05a' => 1,
            '05b' => 1,
            '05c' => 1,
        ];
    }

    public function findUserById(int $id): ?User
    {
        foreach ($this->users as $user) {
            if ($user->getId() == $id) {
                return $user;
            }
        }
        return null;
    }

    // TODO: multiple users may have the same name, it is not a unique username
    public function findUserByName(string $username): ?User
    {
        return null;
    }

    public function findUserByEmail(string $email): ?User
    {
        foreach ($this->users as $user) {
            if ($user->getEmail() == $email) {
                return $user;
            }
        }
        return null;
    }

    public function findUsersBySchoolClass(string $schoolClass): ?array
    {
        $cUsers = [];
        foreach ($this->userSchoolClasses as $c => $userId) {
            if ($c == $schoolClass) {
                $cUsers[] = $this->findUserById($userId);
            }
        }
        return $cUsers;
    }
}