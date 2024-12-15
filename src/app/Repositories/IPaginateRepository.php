<?php

namespace App\Repositories;

interface IPaginateRepository
{
    public function getTotalCount(): int;
}