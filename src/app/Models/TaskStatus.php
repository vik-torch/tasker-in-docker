<?php

namespace App\Models;

enum TaskStatus: string
{
    case NEW = "NEW";
    case DONE = "DONE";
}