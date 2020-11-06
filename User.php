<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
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
    protected string $name;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected string $email;

    public function getEMail(): string
    {
        return $this->email;
    }

    public function getClass()
    {
        // TODO: Implement getForm() method.
        // return $this->
    }

    public function getName(): string
    {
        return $this->name;
    }
}