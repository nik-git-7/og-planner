<?php


namespace ogPlanner\model;


interface INotification
{
    public function isEmailEnabled(): bool;

    public function isOgAppEnabled(): bool;

    public function isWhatsAppEnabled(): bool;
}