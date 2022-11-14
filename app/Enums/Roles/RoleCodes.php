<?php

namespace App\Enums\Roles;

enum RoleCodes: string
{
    case ROOT = 'root';
    case ADMIN = 'admin';
    case VISITOR = 'visitor';
}