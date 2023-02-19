<?php

namespace App;

use App\FortuneTeller\FortuneTeller;
use Exception;

class Divination
{
    /**
     * @throws Exception
     */
    public function index(): void
    {
        echo implode(', ', (new FortuneTeller())->index());
    }
}
