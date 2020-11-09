<?php


namespace ogPlanner\model;

require_once BASEDIR . 'src/ogPlanner/model/ITimetable.php';

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ogPlanner\dao\TimetableRepo")
 * @ORM\Table(name="timetables")
 */
class Timetable implements ITimetable
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
    protected int $lesson;

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
     * @param int $lesson
     * @param string $subject
     */
    public function __construct(int $id, int $timetableId, int $day, int $lesson, string $subject)
    {
        $this->id = $id;
        $this->timetableId = $timetableId;
        $this->day = $day;
        $this->lesson = $lesson;
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
    public function getLesson(): int
    {
        return $this->lesson;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }
}