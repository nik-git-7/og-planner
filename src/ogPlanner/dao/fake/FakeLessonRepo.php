<?php /** @noinspection PhpIncompatibleReturnTypeInspection */

namespace ogPlanner\dao\fake;

use ogPlanner\dao\ILessonRepo;
use ogPlanner\model\ILesson;
use ogPlanner\model\Lesson;


class FakeLessonRepo extends FakeRepo implements ILessonRepo
{
    public function __construct($db)
    {
        parent::__construct($db);
    }

    public function findById(int $id): ?Lesson
    {
        $field = function(ILesson $lesson) {return $lesson->getId();};
        return $this->searchOne($field, $id);
    }

    public function findByTimetableId(int $timetableId): array
    {
        $field = function(ILesson $lesson) {return $lesson->getTimetableId();};
        return $this->searchMulti($field, $timetableId);
    }

    public function findByTimetableIdAndDay(int $timetableId, int $day): array
    {
        $resultLessons = [];
        /** @var ILesson $lesson */
        foreach ($this->db as $lesson) {
            if ($lesson->getTimetableId() == $timetableId && $lesson->getDay() == $day) {
                $resultLessons[] = $lesson;
            }
        }
        return $resultLessons;
    }

    public function findByDay(int $day): array
    {
        $field = function(ILesson $lesson) {return $lesson->getDay();};
        return $this->searchMulti($field, $day);
    }

    public function findByPosition(int $position): array
    {
        $field = function(ILesson $lesson) {return $lesson->getPosition();};
        return $this->searchMulti($field, $position);
    }

    public function findBySubject(string $subject): array
    {
        $field = function(ILesson $lesson) {return $lesson->getSubject();};
        return $this->searchMulti($field, $subject);
    }
}