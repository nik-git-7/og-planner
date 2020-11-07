<?php

namespace ogPlanner\model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users") // Todo: Add repo annotation
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

    public function getEMail(): string
    {
        return $this->email;
    }

    public function getClasses()
    {
        // TODO: Implement getForm() method.
        // return $this->
    }

    public function getName(): string
    {
        return $this->name;
    }
}