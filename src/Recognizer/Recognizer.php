<?php

namespace App\Recognizer;

use App\Constants;

class Recognizer
{
    private array $rawHexagrams;

    /**
     * @param array $rawHexagrams
     */
    public function __construct(array $rawHexagrams)
    {
        $this->rawHexagrams = $rawHexagrams;
    }

    public function analyze(): array
    {
        $hexagrams = [];

        if (isset($this->rawHexagrams) && ! empty($this->rawHexagrams['primary'])) {
            $hexagrams['primary'] = $this->getHexagram();
        }

        return $hexagrams;
    }

    public function getHexagram(): int
    {
        $hexagramNumber = 0;

        $bottom = $this->getBottom();
        $top = $this->getTop();

        var_dump($bottom);

        return $hexagramNumber;
    }

    public function getBottom(): int
    {
        $bottom = array_slice($this->rawHexagrams, 0, 3);

        var_dump($bottom);

        return $this->getThreegram($bottom);
    }

    public function getTop(): int
    {
        $top = array_slice($this->rawHexagrams, 3, 3);

        return $this->getThreegram($top);
    }

    public function getThreegram(array $rawThreegram): int
    {
        $threegram = 0;
        foreach (Constants::THREEGRAMS as $key => $value) {
            if ($rawThreegram === $value) {
                $threegram = $key;
            }
        }

        return $threegram;
    }
}
