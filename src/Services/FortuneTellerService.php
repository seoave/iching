<?php

namespace App\Services;

use App\Constants;
use App\Yarrow\Yarrow;
use Exception;

class FortuneTellerService
{
    private string $message;
    private array $primaryHexagram;
    private array $secondaryHexagram;

    public function __construct()
    {
        $this->message = '1 hexagram';
        $this->primaryHexagram = [];
        $this->secondaryHexagram = [];
    }

    /**
     * @throws Exception
     */
    public function index(): array
    {
        $rows = $this->getYarrowRows();
        $this->primaryHexagram = $this->getYarrowRows();;
        if ($this->hasOldRow($rows)) {
            $this->transformHexagram();
        }

        return [
            $this->primaryHexagram,
            $this->secondaryHexagram,
        ];
    }

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

    public function transformHexagram(): void
    {
        $this->message = '2 hexagrams';
        foreach ($this->primaryHexagram as $value) {
            $secondary[] = match ($value) {
                Constants::OLD_YIN => 7,
                Constants::OLD_YANG => 8,
                default => $value,
            };
        }
        $this->secondaryHexagram = $secondary;
    }
}
