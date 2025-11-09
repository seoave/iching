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
        $hexagrams['secondary'] = $this->secondaryHexagram ? $this->getHexagram($this->secondaryHexagram) : 0;

        return $hexagrams;
    }

    public function getHexagram(array $hexagram): int
    {
        $bottom = $this->getBottom($hexagram);
        $top = $this->getTop($hexagram);

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
        $number = 0;

        // 1
        if ($top === 1) {
            $number = match ($bottom) {
                1 => 1, //1  Heaven, Energy, Creativity 7-7-7
                8 => 12, //2 Earth 8-8-8
                7 => 25, //3 Thunder 8-8-7
                6 => 6, //4 Water 8-7-8
                4 => 33, //5 Mountain 7-8-8
                2 => 44, //6 Wind 7-7-8
                3 => 13, //7 Flame 7-8-7
                5 => 10, //8 Lake 8-7-7
            };
        }

        // 2
        if ($top === 8) {
            $number = match ($bottom) {
                1 => 11, //1  Heaven, Energy, Creativity 7-7-7
                8 => 2, //2 Earth 8-8-8
                7 => 24, //3 Thunder 8-8-7
                6 => 7, //4 Water 8-7-8
                4 => 15, //5 Mountain 7-8-8
                2 => 46, //6 Wind 7-7-8
                3 => 36, //7 Flame 7-8-7
                5 => 19, //8 Lake 8-7-7
            };
        }

        // 3
        if ($top === 7) {
            $number = match ($bottom) {
                1 => 34, //1  Heaven, Energy, Creativity 7-7-7
                8 => 16, //2 Earth 8-8-8
                7 => 51, //3 Thunder 8-8-7
                6 => 40, //4 Water 8-7-8
                4 => 62, //5 Mountain 7-8-8
                2 => 32, //6 Wind 7-7-8
                3 => 55, //7 Flame 7-8-7
                5 => 54, //8 Lake 8-7-7
            };
        }

        // 4
        if ($top === 6) {
            $number = match ($bottom) {
                1 => 5, //1  Heaven, Energy, Creativity 7-7-7
                8 => 8, //2 Earth 8-8-8
                7 => 3, //3 Thunder 8-8-7
                6 => 29, //4 Water 8-7-8
                4 => 39, //5 Mountain 7-8-8
                2 => 48, //6 Wind 7-7-8
                3 => 63, //7 Flame 7-8-7
                5 => 60, //8 Lake 8-7-7
            };
        }

        // 5
        if ($top === 4) {
            $number = match ($bottom) {
                1 => 26, //1  Heaven, Energy, Creativity 7-7-7
                8 => 23, //2 Earth 8-8-8
                7 => 27, //3 Thunder 8-8-7
                6 => 4, //4 Water 8-7-8
                4 => 52, //5 Mountain 7-8-8
                2 => 18, //6 Wind 7-7-8
                3 => 22, //7 Flame 7-8-7
                5 => 41, //8 Lake 8-7-7
            };
        }

        // 6
        if ($top === 2) {
            $number = match ($bottom) {
                1 => 9, //1  Heaven, Energy, Creativity 7-7-7
                8 => 20, //2 Earth 8-8-8
                7 => 42, //3 Thunder 8-8-7
                6 => 59, //4 Water 8-7-8
                4 => 53, //5 Mountain 7-8-8
                2 => 57, //6 Wind 7-7-8
                3 => 37, //7 Flame 7-8-7
                5 => 61, //8 Lake 8-7-7
            };
        }

        // 7
        if ($top === 3) {
            $number = match ($bottom) {
                1 => 14, //1  Heaven, Energy, Creativity 7-7-7
                8 => 35, //2 Earth 8-8-8
                7 => 21, //3 Thunder 8-8-7
                6 => 64, //4 Water 8-7-8
                4 => 56, //5 Mountain 7-8-8
                2 => 50, //6 Wind 7-7-8
                3 => 30, //7 Flame 7-8-7
                5 => 38, //8 Lake 8-7-7
            };
        }

        // 8
        if ($top === 5) {
            $number = match ($bottom) {
                1 => 43, //1  Heaven, Energy, Creativity 7-7-7
                8 => 45, //2 Earth 8-8-8
                7 => 17, //3 Thunder 8-8-7
                6 => 47, //4 Water 8-7-8
                4 => 31, //5 Mountain 7-8-8
                2 => 28, //6 Wind 7-7-8
                3 => 49, //7 Flame 7-8-7
                5 => 58, //8 Lake 8-7-7
            };
        }

        return $number;
    }
}
