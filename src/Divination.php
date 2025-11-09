<?php

/**
 * Class displays divination.
*/

namespace Iching\Core;

use Iching\Core\FortuneTeller\FortuneTeller;
use Exception;

class Divination
{
    /**
     * @throws Exception
     */
    public function index()
    {
        print_r((new FortuneTeller())->index());
    }
}
