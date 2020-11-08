<?php /** @noinspection PhpIncompatibleReturnTypeInspection */


namespace ogPlanner\dao;

require_once BASEDIR . 'src/ogPlanner/model/UserCourseTimetableConnector.php';

use Doctrine\ORM\EntityRepository;
use ogPlanner\model\UserCourseTimetableConnector;


class UserCourseTimetableConnectorRepo extends EntityRepository implements IUserCourseTimetableConnectorRepo
{
    public function findById(int $id): ?UserCourseTimetableConnector
    {
        return $this->find($id);
    }

    public function findByUserId(int $id): array
    {
        return $this->findBy(['userId' => $id]);
    }

    public function findByCourse(string $course): array
    {
        return $this->findBy(['course' => $course]);
    }

    public function findByTimetableId(int $id): array
    {
        return $this->findBy(['timetableId' => $id]);
    }
}