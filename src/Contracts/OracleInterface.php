<?php

namespace Iching\Core\Contracts;

interface OracleInterface
{
    /**
     * Cast the oracle and return 6 line values.
     * Each value is one of: 6 (old Yin), 7 (Yang), 8 (Yin), 9 (old Yang).
     *
     * @return int[]
     * @throws \Exception
     */
    public function cast(): array;
}
