<?php


interface IUser
{
    public function getEMail();

    public function getForm();

    public function getName();

    public function getUsersByClass(): array;
}