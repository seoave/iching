<?php

namespace Iching\Core\Contracts;

use Iching\Core\Domain\ValueObjects\Hexagram;

interface HexagramRepositoryInterface
{
    public function findById(int $id): ?Hexagram;
}
