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

    public function getClass()
    {
        // TODO: Implement getClass() method.
    }

    public function getLesson()
    {
        // TODO: Implement getLesson() method.
    }

    public function getRepresentative()
    {
        // TODO: Implement getRepresentative() method.
    }

    public function getSubject()
    {
        // TODO: Implement getSubject() method.
    }

    public function getRoom()
    {
        // TODO: Implement getRoom() method.
    }

    public function getKind()
    {
        // TODO: Implement getKind() method.
    }

    public function getNotification()
    {
        // TODO: Implement getNotification() method.
    }
}