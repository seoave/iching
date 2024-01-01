<?php

/**
 * Gets yarrow rows and transforms it to hexagrams arrays:
 * - primary hexagram array;
 * - secondary hexagram array.
 */

namespace App\Services;

use App\Constants;
use App\Yarrow\Yarrow;
use Exception;

class FortuneTellerService
{
    private string $message = '1 hexagram';
    private array $raw = [];
    private array $primaryHexagram = [];
    private array $secondaryHexagram = [];

    /**
     * @throws Exception
     */
    public function index(): array
    {
        $this->raw = $this->getYarrowRows();
        $this->primaryHexagram = $this->raw;

        if ($this->hasOldRow($this->raw)) {
            $this->transformPrimaryHexagram();
            $this->transformSecondaryHexagram();
        }

        return [
            'info' => $this->message,
            'raw' => $this->raw,
            'primary' => $this->primaryHexagram,
            'secondary' => $this->secondaryHexagram,
        ];
    }

    /**
     * @throws Exception
     */
    public function getYarrowRows(): array
    {
        $rows = [];

        for ($i = 0; $i < 6; $i++) {
            $rows[] = (new Yarrow())->index();
        }

        return $rows;
    }

    public function hasOldRow(array $rows): bool
    {
        $olds = [Constants::OLD_YIN, Constants::OLD_YANG];

        return count(array_intersect($rows, $olds)) > 0;
    }

    /**
     * Creates secondary hexagram from old lines:
     * old Yang (9) -> Ying (8), old Ying (6) -> Ying (7).
     * Sets new secondary hexagram array.
     *
     * @return void
     */
    public function transformSecondaryHexagram(): void
    {
        $secondary = [];
        $this->message = '2 hexagrams';
        foreach ($this->raw as $value) {
            $secondary[] = match ($value) {
                Constants::OLD_YIN => 7, // old Ying (6) -> Ying (7)
                Constants::OLD_YANG => 8, // old Yang (9) -> Ying (8)
                default => $value,
            };
        }
        $this->secondaryHexagram = $secondary;
    }

    /**
     * Transforms primary hexagram to simplify interpretation.
     * we bring old lines to stable ones:
     * old Yang (9) -> Yang (7), old Ying (6) -> Ying (8).
     * Sets new primary hexagram array.
     *
     * @return void
     */
    public function transformPrimaryHexagram(): void
    {
        $primary = [];
        foreach ($this->raw as $value) {
            $primary[] = match ($value) {
                Constants::OLD_YIN => 8, // old Ying (6) -> Ying (8);
                Constants::OLD_YANG => 7, // old Yang (9) -> Yang (7);
                default => $value,
            };
        }
        $this->primaryHexagram = $primary;
    }
}
