<?php /** @noinspection PhpIncompatibleReturnTypeInspection */


namespace ogPlanner\model;


use Doctrine\ORM\EntityRepository;

class UserCourseTimetableConnectorRepo extends EntityRepository implements IUserCourseTimetableConnectorRepo
{
    public function findConnectorById(int $id): ?UserCourseTimetableConnector
    {
        return $this->find($id);
    }

    public function findConnectorsByUserId(int $id): array
    {
        return $this->findBy(['user_id' => $id]);
    }

    public function findConnectorsByCourse(string $course): array
    {
        return $this->findBy(['course' => $course]);
    }

    public function findConnectorsByTimetableId(int $id): array
    {
        return $this->findBy(['timetable_id' => $id]);
    }
}