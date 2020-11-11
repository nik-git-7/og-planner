<?php

namespace ogPlanner\model;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;


/**
 * @ORM\Entity(repositoryClass="ogPlanner\dao\LessonRepo")
 * @ORM\Table(name="lessons")
 */
class Lesson implements ILesson, JsonSerializable
{
    const MONDAY = 0;
    const TUESDAY = 1;
    const WEDNESDAY = 2;
    const THURSDAY = 3;
    const FRIDAY = 4;
    const SATURDAY = 5;
    const SUNDAY = 6;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int
     */
    protected int $id;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected int $timetableId;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected int $day;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected int $position;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected string $subject;

    /**
     * Timetable constructor.
     * @param int $id
     * @param int $timetableId
     * @param int $day
     * @param int $position
     * @param string $subject
     */
    public function __construct(int $id, int $timetableId, int $day, int $position, string $subject)
    {
        $this->id = $id;
        $this->timetableId = $timetableId;
        $this->day = $day;
        $this->position = $position;
        $this->subject = $subject;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getTimetableId(): int
    {
        return $this->timetableId;
    }

    /**
     * @return int
     */
    public function getDay(): int
    {
        return $this->day;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'timetableId' => $this->getTimetableId(),
            'day' => $this->getDay(),
            'position' => $this->getPosition(),
            'subject' => $this->getSubject()
        ];
    }
}