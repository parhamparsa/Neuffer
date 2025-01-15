<?php

declare(strict_types=1);

namespace App\Infrastructure\Uuid;

use Ramsey\Uuid\Guid\Guid;

class UuidGenerator
{
    public function generateUuid(): string
    {
        return Guid::uuid4()->toString();
    }
}
