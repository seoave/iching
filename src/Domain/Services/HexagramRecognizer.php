<?php

namespace Iching\Core\Domain\Services;

use Iching\Core\Constants;
use InvalidArgumentException;

class HexagramRecognizer
{
    /**
     * Maps [top trigram][bottom trigram] → hexagram number (1–64).
     */
    private const TABLE = [
        1 => [1 => 1,  8 => 12, 7 => 25, 6 => 6,  4 => 33, 2 => 44, 3 => 13, 5 => 10],
        8 => [1 => 11, 8 => 2,  7 => 24, 6 => 7,  4 => 15, 2 => 46, 3 => 36, 5 => 19],
        7 => [1 => 34, 8 => 16, 7 => 51, 6 => 40, 4 => 62, 2 => 32, 3 => 55, 5 => 54],
        6 => [1 => 5,  8 => 8,  7 => 3,  6 => 29, 4 => 39, 2 => 48, 3 => 63, 5 => 60],
        4 => [1 => 26, 8 => 23, 7 => 27, 6 => 4,  4 => 52, 2 => 18, 3 => 22, 5 => 41],
        2 => [1 => 9,  8 => 20, 7 => 42, 6 => 59, 4 => 53, 2 => 57, 3 => 37, 5 => 61],
        3 => [1 => 14, 8 => 35, 7 => 21, 6 => 64, 4 => 56, 2 => 50, 3 => 30, 5 => 38],
        5 => [1 => 43, 8 => 45, 7 => 17, 6 => 47, 4 => 31, 2 => 28, 3 => 49, 5 => 58],
    ];

    /**
     * Recognize hexagram number (1–64) from 6 stable line values (7 or 8 only).
     *
     * @param  int[] $lines
     * @throws InvalidArgumentException
     */
    public function recognize(array $lines): int
    {
        $bottom = $this->getThreegram(array_slice($lines, 0, 3));
        $top    = $this->getThreegram(array_slice($lines, 3, 3));

        if (!isset(self::TABLE[$top][$bottom])) {
            throw new InvalidArgumentException("Unknown hexagram combination: top=$top, bottom=$bottom");
        }

        return self::TABLE[$top][$bottom];
    }

    /**
     * @param  int[] $three
     * @throws InvalidArgumentException
     */
    private function getThreegram(array $three): int
    {
        foreach (Constants::THREEGRAMS as $key => $value) {
            if ($three === $value) {
                return $key;
            }
        }

        throw new InvalidArgumentException('Unknown trigram: [' . implode(', ', $three) . ']');
    }
}
