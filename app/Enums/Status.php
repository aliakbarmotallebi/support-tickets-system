<?php

namespace App\Enums;

enum Status: string
{
    case OPEN = 'open';
    case NEW = 'new';
    case PENDING = 'pending';
    case CLOSED = 'closed';
    case SOLVED = 'solved';
}