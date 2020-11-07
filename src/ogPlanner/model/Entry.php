<?php

namespace ogPlanner\model;

class Entry implements IEntry
{
    protected string $schoolClass;
    protected int $lesson;
    protected string $representative;
    protected string $subject;
    protected string $room;
    protected string $kind;
    protected string $notification;

    /**
     * Entry constructor.
     * @param string $schoolClass
     * @param int $lesson
     * @param string $representative
     * @param string $subject
     * @param string $room
     * @param string $kind
     * @param string $notification
     */
    public function __construct(string $schoolClass, int $lesson, string $representative, string $subject, string $room, string $kind, string $notification)
    {
        $this->schoolClass = $schoolClass;
        $this->lesson = $lesson;
        $this->representative = $representative;
        $this->subject = $subject;
        $this->room = $room;
        $this->kind = $kind;
        $this->notification = $notification;
    }

    /**
     * @return string
     */
    public function getSchoolClass(): string
    {
        return $this->schoolClass;
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
}