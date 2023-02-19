<?php

namespace App\FortuneTeller;

use Exception;
use App\Services\FortuneTellerService;

class FortuneTeller
{
    /**
     * @throws Exception
     */
    public function index(): array
    {
        return (new FortuneTellerService())->index();
    }
}
