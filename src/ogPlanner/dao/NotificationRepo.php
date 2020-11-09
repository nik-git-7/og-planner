<?php /** @noinspection PhpIncompatibleReturnTypeInspection */


namespace ogPlanner\dao;

require_once BASEDIR . 'src/ogPlanner/dao/INotificationRepo.php';
require_once BASEDIR . 'src/ogPlanner/model/Notification.php';

use Doctrine\ORM\EntityRepository;
use ogPlanner\model\Notification;

class NotificationRepo extends EntityRepository implements INotificationRepo
{

    public function findById(int $id): ?Notification
    {
        return $this->find($id);
    }

    public function findByEmail(bool $email): array
    {
        return $this->findBy(['email' => $email]);
    }

    public function findByOgApp(bool $ogApp): array
    {
        return $this->findBy(['ogApp' => $ogApp]);
    }

    public function findByWhatsApp(bool $whatsApp): array
    {
        return $this->findBy(['whatsApp' => $whatsApp]);
    }
}