<?php /** @noinspection PhpIncompatibleReturnTypeInspection */

namespace ogPlanner\dao\fake;

use ogPlanner\dao\INotificationRepo;
use ogPlanner\model\INotification;
use ogPlanner\model\Notification;


class FakeNotificationRepo extends FakeRepo implements INotificationRepo
{
    public function __construct($db)
    {
        parent::__construct($db);
    }

    public function findById(int $id): ?Notification
    {
        $field = function(INotification $notification) {return $notification->getId();};
        return $this->searchOne($field, $id);
    }

    public function findByEmail(bool $emailEnabled): array
    {
        $field = function(INotification $notification) {return $notification->isEmailEnabled();};
        return $this->searchMulti($field, $emailEnabled);
    }

    public function findByOgApp(bool $ogAppEnabled): array
    {
        $field = function(INotification $notification) {return $notification->isOgAppEnabled();};
        return $this->searchMulti($field, $ogAppEnabled);
    }

    public function findByWhatsApp(bool $whatsAppEnabled): array
    {
        $field = function(INotification $notification) {return $notification->isWhatsAppEnabled();};
        return $this->searchMulti($field, $whatsAppEnabled);
    }
}