<?php
namespace App\Enums;
enum TaskStatus: string
{
    case STATUS_PENDING = 'pending';
    case STATUS_DONE = 'done';
}