<?php /** @noinspection PhpIncompatibleReturnTypeInspection */


namespace ogPlanner\model;


use Doctrine\ORM\EntityRepository;

class TimetableRepo extends EntityRepository implements ITimetableRepo
{
    public function findTimetableById(int $id): ?ITimetable
    {
        return $this->find($id);
    }

    public function findTimetablesByTimetableId(int $id): array
    {
        return $this->findBy(['timetable_id' => $id]);
    }

    public function findTimetablesByDay(int $day): array
    {
        return $this->findBy(['day' => $day]);
    }

    public function findTimetablesByLesson(int $lesson): array
    {
        return $this->findBy(['lesson' => $lesson]);
    }

    public function findTimetablesBySubject(string $subject): array
    {
        return $this->findBy(['subject' => $subject]);
    }
}