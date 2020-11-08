<?php


namespace ogPlanner\model;

require_once 'SimpleUserCourseTimetableConnector.php';


class SimpleUserRepo implements IUserRepo
{
    private array $users;

    public function __construct()
    {
        $this->users = [
            new User(1, 'haha@miregal.de', 'Nik'),
            new User(2, 'haha@miregal.de', 'Nik'),
            new User(3, 'haha@miregal.de', 'Nik'),
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
    public function findUsersByName(string $username): ?User
    {
        return null;
    }

    public function findUsersByEmail(string $email): ?User
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
        $connector = new SimpleUserCourseTimetableConnector();
        $searchedUsers = [];
        foreach ($connector->getConnection() as $connection) {
            if ($connection['school_class'] == $schoolClass) {
                $searchedUsers[] = $this->findUserById($connection['user_id']);
            }
        }
        return $searchedUsers;
    }
}