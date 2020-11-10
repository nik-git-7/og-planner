<?php /** @noinspection PhpIncompatibleReturnTypeInspection */

namespace ogPlanner\dao;

use Doctrine\ORM\EntityRepository;
use ogPlanner\model\ILesson;
use ogPlanner\model\Lesson;


class LessonRepo extends EntityRepository implements ILessonRepo
{
    public function findById(int $id): ?Lesson
    {
        return $this->find($id);
    }

    public function findByTimetableId(int $timetableId): array
    {
        return $this->findBy(['timetableId' => $timetableId]);
    }

    public function findByTimetableIdAndDay(int $timetableId, int $day): array
    {
        return $this->findBy(['timetableId' => $timetableId, 'day' => $day]);
    }

    public function findByDay(int $day): array
    {
        return $this->findBy(['day' => $day]);
    }

    public function findByPosition(int $position): array
    {
        return $this->findBy(['lesson' => $position]);
    }

    public function findBySubject(string $subject): array
    {
        return $this->findBy(['subject' => $subject]);
    }
}