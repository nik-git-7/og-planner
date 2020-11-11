<?php

namespace ogPlanner\model;

use JsonSerializable;


class Entry implements IEntry, JsonSerializable
{
    protected string $course;
    protected int $position;
    protected string $representative;
    protected string $subject;
    protected string $room;
    protected string $kind;
    protected string $notification;

    /**
     * Entry constructor.
     * @param string $course
     * @param int $position
     * @param string $representative
     * @param string $subject
     * @param string $room
     * @param string $kind
     * @param string $notification
     */
    public function __construct(string $course, int $position, string $representative, string $subject, string $room, string $kind, string $notification)
    {
        $this->course = $course;
        $this->position = $position;
        $this->representative = $representative;
        $this->subject = $subject;
        $this->room = $room;
        $this->kind = $kind;
        $this->notification = $notification;
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
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @return string
     */
    public function getRepresentative(): string
    {
        return $this->representative;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getRoom(): string
    {
        return $this->room;
    }

    /**
     * @return string
     */
    public function getKind(): string
    {
        return $this->kind;
    }

    /**
     * @return string
     */
    public function getNotification(): string
    {
        return $this->notification;
    }

    public function jsonSerialize()
    {
        return [
            'course' => $this->getCourse(),
            'position' => $this->getPosition(),
            'representative' => $this->getRepresentative(),
            'subject' => $this->getSubject(),
            'room' => $this->getRoom(),
            'kind' => $this->getKind(),
            'notification' => $this->getNotification(),
        ];
    }
}