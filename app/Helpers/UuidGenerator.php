<?php

namespace App\Helpers;

use Ramsey\Uuid\Uuid;

class UuidGenerator
{
    public static function get(): string
    {
        return Uuid::uuid4()->toString();
    }
}
