<?php /** @noinspection PhpIncompatibleReturnTypeInspection */

namespace ogPlanner\dao;

use Doctrine\ORM\EntityRepository;
use ogPlanner\model\IUserCourseTimetableConnector;


class UserCourseTimetableConnectorRepo extends EntityRepository implements IUserCourseTimetableConnectorRepo
{
    public function findById(int $id): ?IUserCourseTimetableConnector
    {
        return $this->find($id);
    }

    public function findByUserId(int $userId): array
    {
        return $this->findBy(['userId' => $userId]);
    }

    public function findByCourse(string $course): array
    {
        return $this->findBy(['course' => $course]);
    }

    public function findByTimetableId(int $timetableId): array
    {
        return $this->findBy(['timetableId' => $timetableId]);
    }
}