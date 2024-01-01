<?php

/**
 * Class recognizes hexagram.
 * Gets rawHexagram and returns numbers of primary and secondary hexagrams.
 */

namespace App\Recognizer;

use App\Constants;

class Recognizer
{
    private array $primaryHexagram = [];
    private array $secondaryHexagram = [];

    /**
     * @param array $rawHexagrams
     */
    public function __construct(array $rawHexagrams)
    {
        $this->primaryHexagram = $rawHexagrams['primary'];
        $this->secondaryHexagram = $rawHexagrams['secondary'] ?: [];
    }

    public function analyze(): array
    {
        $hexagrams = [];

        $hexagrams['primary'] = $this->getHexagram($this->primaryHexagram);
        $hexagrams['secondary'] = $this->getHexagram($this->secondaryHexagram);

        return $hexagrams;
    }

    public function getHexagram(array $hexagram): int
    {
        $bottom = $this->getBottom($hexagram);
        $top = $this->getTop($hexagram);

        echo 'top+bottom: <br>';
        var_dump($top);
        var_dump($bottom);
        echo '<br>';

        return $this->getHexagramNumber($top, $bottom);
    }

    public function getBottom($hexagram): int
    {
        $bottom = array_slice($hexagram, 0, 3);

        return $this->getThreegram($bottom);
    }

    public function getTop($hexagram): int
    {
        $top = array_slice($hexagram, 3, 3);

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

    private function getHexagramNumber(int $top, int $bottom): int
    {
        return 1;
    }
}
