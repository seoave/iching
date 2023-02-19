<?php

namespace App\Services;

use App\Yarrow\Yarrow;

class FortuneTellerService
{
    public function index(): array
    {
        $hexagram = [];

        for ($i = 0; $i < 6; $i++) {
            $hexagram[] = (new Yarrow())->index();
        }

        return $hexagram;
    }
}
