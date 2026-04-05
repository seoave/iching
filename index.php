<?php

use Iching\Core\Domain\Divination;
use Iching\Core\Infrastructure\Oracle\YarrowOracle;
use Iching\Core\Infrastructure\Repository\FileHexagramRepository;

require_once __DIR__ . '/vendor/autoload.php';

$divination = new Divination(
    new YarrowOracle(),
    new FileHexagramRepository(),
);

try {
    $result = $divination->divine();
    print_r($result->toArray());
} catch (Exception $e) {
    echo 'Divination failed: ' . $e->getMessage() . PHP_EOL;
}
