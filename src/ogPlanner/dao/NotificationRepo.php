<?php /** @noinspection PhpIncompatibleReturnTypeInspection */

namespace ogPlanner\dao;

use Doctrine\ORM\EntityRepository;
use ogPlanner\model\Notification;


class NotificationRepo extends EntityRepository implements INotificationRepo
{

    public function findById(int $id): ?Notification
    {
        return $this->find($id);
    }

    public function findByEmail(bool $emailEnabled): array
    {
        return $this->findBy(['email' => $emailEnabled]);
    }

    public function findByOgApp(bool $ogAppEnabled): array
    {
        return $this->findBy(['ogApp' => $ogAppEnabled]);
    }

    public function findByWhatsApp(bool $whatsAppEnabled): array
    {
        return $this->findBy(['whatsApp' => $whatsAppEnabled]);
    }
}