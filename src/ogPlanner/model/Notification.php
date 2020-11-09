<?php


namespace ogPlanner\model;

require_once BASEDIR . 'src/ogPlanner/model/INotification.php';

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