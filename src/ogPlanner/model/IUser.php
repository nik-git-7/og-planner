<?php

namespace ogPlanner\model;

interface IUser
{
    public function getId(): int;

    public function getEmail(): string;

    public function getName(): string;
}