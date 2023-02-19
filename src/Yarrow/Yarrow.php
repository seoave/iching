<?php

namespace App\Yarrow;

use App\Constants;
use Exception;

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
     * @throws Exception
     */
    public function index(): int
    {
        //  $this->showBunches($this->left, $this->right);
        $this->changes();

        return $this->getGram();
    }

    public function showBunches(int $left, int $right): void
    {
        echo 'Left bunch: ' . $left . ', ' . 'Right bunch: ' . $right . "\n";
    }

    /**
     * @throws Exception
     */
    public function change(): void
    {
        if ($this->right > 1) {
            --$this->right;
        }

        $substractFromLeft = $this->left % 4 !== 0 ? $this->left % 4 : 4;

        $substractFromRight = $this->right % 4 !== 0 ? $this->right % 4 : 4;

        $this->left -= $substractFromLeft;
        $this->right -= $substractFromRight;

        $this->split();
    }

    /**
     * @throws Exception
     */
    public function changes(): void
    {
        $this->change();
        $this->change();
        $this->change();
    }

    public function getGram(): int
    {
        //   $this->showBunches($this->left, $this->right);
        $row = ($this->left + $this->right) / 4;
        echo $row . "\n";

        return $row;
    }

    /**
     * @throws Exception
     */
    public function split(): void
    {
        $bunch = ! empty($this->left) && ! empty($this->right) ? $this->left + $this->right : Constants::STICKS;
        $middle = round($bunch / 2);
        $deviation = random_int(1, 3);
        $min = $middle - $deviation;
        $max = $middle + $deviation;
        $this->left = random_int($min, $max);
        $this->right = $bunch - $this->left;
    }
}
