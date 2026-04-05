<?php

namespace Iching\Core\Contracts;

use Iching\Core\Domain\ValueObjects\DivinationResult;

interface DivinationInterface
{
    public function divine(): DivinationResult;
}
