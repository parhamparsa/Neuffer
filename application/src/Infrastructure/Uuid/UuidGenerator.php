<?php

namespace App\Infrastructure\Uuid;

use Ramsey\Uuid\Guid\Guid;

class UuidGenerator
{
    public function generateUuid(): string
    {
        return Guid::uuid4()->toString();
    }
}