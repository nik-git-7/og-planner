<?php

namespace ogPlanner\model;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;


/**
 * @ORM\Entity(repositoryClass="ogPlanner\dao\UserRepo")
 * @ORM\Table(name="users")
 */
class User implements IUser, JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int
     */
    protected int $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected string $name;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected string $email;

    /**
     * @ORM\Column(type="integer", options={"default": 1})
     * @var int
     */
    protected int $notificationId;

    public function __construct(int $id, string $email, string $name, int $notificationId = 1)
    {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->notificationId = $notificationId;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNotificationId(): int
    {
        return $this->notificationId;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'email' => $this->getEmail(),
            'name' => $this->getName(),
            'notificationId' => $this->getNotificationId()
        ];
    }
}