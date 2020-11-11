<?php

namespace ogPlanner\model;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;


/**
 * Class Notification
 * @package ogPlanner\model
 * @ORM\Entity(repositoryClass="ogPlanner\dao\NotificationRepo")
 * @ORM\Table(name="notifications")
 */
class Notification implements INotification, JsonSerializable
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

    public function __construct(int $id, bool $email = true, bool $ogApp = false, bool $whatsApp = false)
    {
        $this->id = $id;
        $this->email = $email;
        $this->ogApp = $ogApp;
        $this->whatsApp = $whatsApp;
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

    /**
     * @return bool
     */
    public function getEmail(): bool
    {
        return $this->email;
    }

    /**
     * @return bool
     */
    public function getOgApp(): bool
    {
        return $this->ogApp;
    }

    /**
     * @return bool
     */
    public function getWhatsApp(): bool
    {
        return $this->whatsApp;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'email' => $this->getEmail(),
            'ogApp' => $this->getOgApp(),
            'whatsApp' => $this->getWhatsApp()
        ];
    }
}