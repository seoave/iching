<?php

/*
 * Class interprets divination.
 */

namespace App\FortuneTeller;

use App\Recognizer\Recognizer;
use Exception;
use App\Services\FortuneTellerService;

class FortuneTeller
{
    private array $rawHexagrams = [];

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->rawHexagrams = (new FortuneTellerService())->index();
    }

    /**
     * @throws Exception
     */
    public function index(): array
    {
        $recognizer = (new Recognizer($this->rawHexagrams))->analyze();

        echo '<pre>';
        var_dump($recognizer);
        echo '</pre>';

        //return $rawHexagrams;
        return [];
    }
}
