<?php /** @noinspection PhpIncompatibleReturnTypeInspection */

namespace ogPlanner\dao;

use Doctrine\ORM\EntityRepository;
use ogPlanner\model\ILesson;


class LessonRepo extends EntityRepository implements ILessonRepo
{
    public function findById(int $id): ?ILesson
    {
        return $this->find($id);
    }

    public function findByTimetableId(int $id): array
    {
        return $this->findBy(['timetableId' => $id]);
    }

    public function findByTimetableIdAndDay(int $id, int $day): array
    {
        return $this->findBy(['timetableId' => $id, 'day' => $day]);
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