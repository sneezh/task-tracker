<?php

declare(strict_types=1);

namespace App\Common\Domain;

trait TimestampableTrait
{
    private ?\DateTimeImmutable $createdAt = null;
    private ?\DateTimeImmutable $updatedAt = null;
}
