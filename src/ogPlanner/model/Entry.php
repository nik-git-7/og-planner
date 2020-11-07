<?php

namespace ogPlanner\model;

class Entry implements IEntry
{
    protected string $class;
    protected int $lesson;
    protected string $representative;
    protected string $subject;
    protected string $room;
    protected string $kind;
    protected string $notification;

    /**
     * Entry constructor.
     * @param string $class
     * @param int $lesson
     * @param string $representative
     * @param string $subject
     * @param string $room
     * @param string $kind
     * @param string $notification
     */
    public function __construct(string $class, int $lesson, string $representative, string $subject, string $room, string $kind, string $notification)
    {
        $this->class = $class;
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
    public function getClass(): string
    {
        return $this->class;
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