<?php

namespace App\Services;

use App\Yarrow\Yarrow;

class FortuneTellerService
{
    public function index(): array
    {
        $hexagram = [];

        $hexagram[] = (new Yarrow())->index();
        $hexagram[] = (new Yarrow())->index();
        $hexagram[] = (new Yarrow())->index();
        $hexagram[] = (new Yarrow())->index();
        $hexagram[] = (new Yarrow())->index();
        $hexagram[] = (new Yarrow())->index();

        return $hexagram;
    }
}
