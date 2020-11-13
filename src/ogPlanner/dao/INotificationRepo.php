<?php

namespace ogPlanner\dao;

use ogPlanner\model\INotification;


interface INotificationRepo
{
    public function findById(int $id): ?INotification;

    public function findByEmail(bool $emailEnabled): array;

    public function findByOgApp(bool $ogAppEnabled): array;

    public function findByWhatsApp(bool $whatsAppEnabled): array;
}