<?php

namespace Iching\Core\Domain\ValueObjects;

class Hexagram
{
    public function __construct(
        public int $number,
        public string $name,
        public string $description,
        public string $keywords,
        public string $interpretation,
        public string $worlds = '',
        public string $potential = '',
    ) {}

    public function toArray(): array
    {
        return [
            'number'         => $this->number,
            'name'           => $this->name,
            'description'    => $this->description,
            'keywords'       => $this->keywords,
            'interpretation' => $this->interpretation,
            'worlds'         => $this->worlds,
            'potential'      => $this->potential,
        ];
    }
}
