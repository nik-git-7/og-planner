<?php

// Todo: Use Doctrine foreign keys?
namespace ogPlanner\model;

require_once BASEDIR . 'src/ogPlanner/model/IUserCourseTimetableConnector.php';

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ogPlanner\dao\UserCourseTimetableConnectorRepo")
 * @ORM\Table(name="user_schoolclass_timetable_connector")
 */
class UserCourseTimetableConnector implements IUserCourseTimetableConnector
{
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
    protected int $userId;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected string $course;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     * @var int
     */
    protected int $timetableId;

    public function __construct($id = false, $userId = false, $course = false, $timetableId = false)
    {
        if ($id) {
            $this->id = $id;
            $this->userId = $userId;
            $this->course = $course;
            $this->timetableId = $timetableId;
        }
    }

    public function getConnection(): array
    {
        return ['user_id' => $this->id, 'course' => $this->course, 'timetable_id' => $this->timetableId];
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
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getCourse(): string
    {
        return $this->course;
    }

    /**
     * @return int
     */
    public function getTimetableId(): int
    {
        return $this->timetableId;
    }
}