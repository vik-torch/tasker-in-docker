<?php

namespace App\Models;

interface IUserModel
{
    public function getId();
    public function getName();
    public function getEmail();
}