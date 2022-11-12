<?php

namespace App\Enums\Authorizations;

enum Statuses: string
{
    case ACTIVE = 'active';
    case BANNED = 'banned';
}