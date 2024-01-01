<?php

/**
 * Class displays divination.
*/

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
        print_r((new FortuneTeller())->index());
    }
}
