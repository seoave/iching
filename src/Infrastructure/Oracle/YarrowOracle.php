<?php

namespace Iching\Core\Infrastructure\Oracle;

use Exception;
use Iching\Core\Contracts\OracleInterface;

class YarrowOracle implements OracleInterface
{
    /**
     * Cast six yarrow-stick lines and return their raw values.
     *
     * @return int[]  Six values, each one of: 6 (old Yin), 7 (Yang), 8 (Yin), 9 (old Yang)
     * @throws Exception
     */
    public function cast(): array
    {
        $lines = [];

        for ($i = 0; $i < 6; $i++) {
            $lines[] = (new Yarrow())->castLine();
        }

        return $lines;
    }
}
