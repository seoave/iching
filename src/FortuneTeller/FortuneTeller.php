<?php

/*
 * Class interprets divination.
 */

namespace App\FortuneTeller;

use App\Constants;
use App\Recognizer\Recognizer;
use App\Services\Repository;
use Exception;
use App\Services\FortuneTellerService;

class FortuneTeller
{
    private array $rawHexagrams = [];

    private int $primaryHexagram = 0;
    private int $secondaryHexagram = 0;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->rawHexagrams = (new FortuneTellerService())->index();
        $recognizer = (new Recognizer($this->rawHexagrams))->analyze();
        $this->primaryHexagram = $recognizer['primary'];
        $this->secondaryHexagram = $recognizer['secondary'];
    }

    /**
     * @throws Exception
     */
    public function index(): array
    {
        echo 'primary: ' . $this->primaryHexagram . '<br>';

        if ($this->secondaryHexagram) {
            echo 'secondary: ' . $this->secondaryHexagram . '<br>';
        } else {
            echo 'secondary: No changing lines.<br>';
        }

        $hexagramData = (new Repository())->getHexagramDataById(2);

        print_r($hexagramData);

        return [];
    }
}
