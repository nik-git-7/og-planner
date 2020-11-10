<?php

namespace ogPlanner\model;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class Notification
 * @package ogPlanner\model
 * @ORM\Entity(repositoryClass="ogPlanner\dao\NotificationRepo")
 * @ORM\Table(name="notifications")
 */
class Notification implements INotification
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int
     */
    protected int $id;

    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default": true})
     */
    protected bool $email;

    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default": false})
     */
    protected bool $ogApp;

    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default": false})
     */
    protected bool $whatsApp;

    public function __construct($id = false, $email = false, $ogApp = false, $whatsApp = false)
    {
        if ($id) {
            $this->id = $id;
            $this->email = $email;
            $this->ogApp = $ogApp;
            $this->whatsApp = $whatsApp;
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isEmailEnabled(): bool
    {
        return $this->email;
    }

    /**
     * @return bool
     */
    public function isOgAppEnabled(): bool
    {
        return $this->ogApp;
    }

    /**
     * @return bool
     */
    public function isWhatsAppEnabled(): bool
    {
        return $this->whatsApp;
    }
}