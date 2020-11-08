<?php /** @noinspection PhpIncompatibleReturnTypeInspection */


namespace ogPlanner\model;


use Doctrine\ORM\EntityRepository;

class UserCourseTimetableConnectorRepo extends EntityRepository implements IUserCourseTimetableConnectorRepo
{
    public function findById(int $id): ?UserCourseTimetableConnector
    {
        return $this->find($id);
    }

    public function findByUserId(int $id): array
    {
        return $this->findBy(['user_id' => $id]);
    }

    public function findByCourse(string $course): array
    {
        return $this->findBy(['course' => $course]);
    }

    public function findByTimetableId(int $id): array
    {
        return $this->findBy(['timetable_id' => $id]);
    }
}