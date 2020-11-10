<?php

namespace ogPlanner\dao;

use ogPlanner\model\Notification;


interface INotificationRepo
{
    public function findById(int $id): ?Notification;

    public function findByEmail(bool $emailEnabled): array;

    public function findByOgApp(bool $ogAppEnabled): array;

    public function findByWhatsApp(bool $whatsAppEnabled): array;
}