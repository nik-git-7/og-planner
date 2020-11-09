<?php

namespace ogPlanner\dao;

use ogPlanner\model\Notification;


interface INotificationRepo
{
    public function findById(int $id): ?Notification;

    public function findByEmail(bool $email): array;

    public function findByOgApp(bool $ogApp): array;

    public function findByWhatsApp(bool $whatsApp): array;
}