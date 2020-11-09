<?php /** @noinspection PhpIncompatibleReturnTypeInspection */

namespace ogPlanner\dao;

use Doctrine\ORM\EntityRepository;
use ogPlanner\model\ITimetable;


class TimetableRepo extends EntityRepository implements ITimetableRepo
{
    public function findById(int $id): ?ITimetable
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

    public function findByLesson(int $lesson): array
    {
        return $this->findBy(['lesson' => $lesson]);
    }

    public function findBySubject(string $subject): array
    {
        return $this->findBy(['subject' => $subject]);
    }
}