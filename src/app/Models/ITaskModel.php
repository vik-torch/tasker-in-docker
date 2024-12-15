<?php

namespace App\Models;

interface ITaskModel
{
    public function getId(): int;
    public function getText(): string;
    public function getStatus();
    public function getUserId(): int;
}