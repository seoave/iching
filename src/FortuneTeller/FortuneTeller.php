<?php

namespace App\FortuneTeller;

use App\Recognizer\Recognizer;
use Exception;
use App\Services\FortuneTellerService;

class FortuneTeller
{
    /**
     * @throws Exception
     */
    public function index(): array
    {
        $rawHexagrams = (new FortuneTellerService())->index();

        var_dump((new Recognizer($rawHexagrams))->analyze());

        //return $rawHexagrams;
        return [];
    }
}
