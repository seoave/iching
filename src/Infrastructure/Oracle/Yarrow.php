<?php

namespace Iching\Core\Infrastructure\Oracle;

use Exception;
use Iching\Core\Constants;

/**
 * Simulates a single yarrow-stick division cycle.
 * Internal implementation detail of YarrowOracle — not part of the public API.
 */
class Yarrow
{
    private int $left = 0;
    private int $right = 0;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->split();
    }

    /**
     * Run three changes and return the resulting line value (6, 7, 8, or 9).
     *
     * @throws Exception
     */
    public function castLine(): int
    {
        $this->change();
        $this->change();
        $this->change();

        return ($this->left + $this->right) / 4;
    }

    /**
     * @throws Exception
     */
    private function change(): void
    {
        if ($this->right > 1) {
            --$this->right;
        }

        $subtractFromLeft  = $this->left % 4 !== 0 ? $this->left % 4 : 4;
        $subtractFromRight = $this->right % 4 !== 0 ? $this->right % 4 : 4;

        $this->left  -= $subtractFromLeft;
        $this->right -= $subtractFromRight;

        $this->split();
    }

    /**
     * @throws Exception
     */
    private function split(): void
    {
        $bunch    = $this->left > 0 && $this->right > 0
            ? $this->left + $this->right
            : Constants::STICKS;
        $middle   = (int) round($bunch / 2);
        $deviation = random_int(1, 3);
        $this->left  = random_int($middle - $deviation, $middle + $deviation);
        $this->right = $bunch - $this->left;
    }
}
