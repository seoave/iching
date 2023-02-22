<?php

namespace App\Services;

use App\Constants;
use App\Yarrow\Yarrow;
use Exception;

class FortuneTellerService
{
    /**
     * @throws Exception
     */
    public function index(): array
    {
        $hexagramEntity = [
            'message' => 'One hexagram',
            'secondary' => [],
        ];

        $rows = $this->getYarrowRows();
        $hexagramEntity['primary'] = $rows;
        if ($this->hasOldRow($rows)) {
            $hexagramEntity['message'] = '2 hexagrams';
            foreach ($rows as $value) {
                $hexagramEntity['secondary'][] = match ($value) {
                    Constants::OLD_YIN => 7,
                    Constants::OLD_YANG => 8,
                    default => $value,
                };
            }
        }

        return $hexagramEntity;
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
}
