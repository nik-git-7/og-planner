<?php

namespace ogPlanner\model;

/**
 * @ORM\Entity(repositoryClass="UserRepository")
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

    public function getSchoolClasses()
    {
        // TODO: Implement getForm() method.
        // return $this->
    }

    public function getName(): string
    {
        return $this->name;
    }
}