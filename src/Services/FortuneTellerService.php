<?php

/*Gets yarrow rows and transforms it to hexagrams.*/

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

//    public function __construct()
//    {
//        $this->message = '1 hexagram';
//    }

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

    public function transformSecondaryHexagram(): void
    {
        $secondary = [];
        $this->message = '2 hexagrams';
        foreach ($this->raw as $value) {
            $secondary[] = match ($value) {
                Constants::OLD_YIN => 7,
                Constants::OLD_YANG => 8,
                default => $value,
            };
        }
        $this->secondaryHexagram = $secondary;
    }

    public function transformPrimaryHexagram(): void
    {
        $primary = [];
        foreach ($this->raw as $value) {
            $primary[] = match ($value) {
                Constants::OLD_YIN => 8,
                Constants::OLD_YANG => 7,
                default => $value,
            };
        }
        $this->primaryHexagram = $primary;
    }
}
