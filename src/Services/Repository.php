<?php

/** Class interacts with storage. */

namespace App\Services;

use App\Constants;

class Repository
{
    public function getHexagramDataById(int $id): ?array
    {
        // Find file
        $hexagrams_dir = Constants::APP_DIR . '/storage/hexagrams/';
        $hexagrams = glob($hexagrams_dir . '*.php');
        $wantedFile = $hexagrams_dir . $id . '.php';

        $position = array_search($wantedFile, $hexagrams);

        if ($position === false) {
            return null;
        }

        $foundHexagram = $hexagrams[$position];

        return include $foundHexagram;
    }
}
