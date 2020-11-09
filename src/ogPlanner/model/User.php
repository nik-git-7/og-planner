<?php

namespace ogPlanner\model;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="ogPlanner\dao\UserRepo")
 * @ORM\Table(name="users")
 */
class User implements IUser
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
    protected string $name; // Todo: Nullable?

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

    public function __construct($id = false, $email = false, $name = false)
    {
        if ($id) {
            $this->id = $id;
            $this->email = $email;
            $this->name = $name;
        }
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
}