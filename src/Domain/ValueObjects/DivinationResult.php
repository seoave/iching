<?php

namespace Iching\Core\Domain\ValueObjects;

class DivinationResult
{
    public function __construct(
        public Hexagram $primary,
        public ?Hexagram $secondary = null,
    ) {}

    public function hasSecondary(): bool
    {
        return $this->secondary !== null;
    }

    public function toArray(): array
    {
        return [
            'primary'   => $this->primary->toArray(),
            'secondary' => $this->secondary?->toArray(),
        ];
    }
}
