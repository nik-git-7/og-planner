<?php /** @noinspection PhpIncompatibleReturnTypeInspection */

namespace ogPlanner\dao\fake;

use ogPlanner\dao\IUserCourseTimetableConnectorRepo;
use ogPlanner\model\IUserCourseTimetableConnector;
use ogPlanner\model\UserCourseTimetableConnector;


class FakeUserCourseTimetableConnectorRepo extends FakeRepo implements IUserCourseTimetableConnectorRepo
{
    public function __construct($db)
    {
        parent::__construct($db);
    }

    public function findById(int $id): ?UserCourseTimetableConnector
    {
        $field = function(IUserCourseTimetableConnector $uctc) {return $uctc->getId();};
        return $this->searchOne($field, $id);
    }

    public function findByUserId(int $userId): array
    {
        $field = function(IUserCourseTimetableConnector $uctc) {return $uctc->getUserId();};
        return $this->searchMulti($field, $userId);
    }

    public function findByCourse(string $course): array
    {
        $field = function(IUserCourseTimetableConnector $uctc) {return $uctc->getCourse();};
        return $this->searchMulti($field, $course);
    }

    public function findByTimetableId(int $timetableId): array
    {
        $field = function(IUserCourseTimetableConnector $uctc) {return $uctc->getTimetableId();};
        return $this->searchMulti($field, $timetableId);
    }
}