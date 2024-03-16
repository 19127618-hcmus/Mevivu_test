<?php

namespace App\Enums\User;

use App\Support\Enum;

enum UserRoles: int
{
    use Enum;

    case Member = 1;
}
