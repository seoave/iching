<?php

namespace Iching\Core\Domain;

use Exception;
use Iching\Core\Contracts\DivinationInterface;
use Iching\Core\Contracts\HexagramRepositoryInterface;
use Iching\Core\Contracts\OracleInterface;
use Iching\Core\Domain\Services\HexagramRecognizer;
use Iching\Core\Domain\Services\LineTransformer;
use Iching\Core\Domain\ValueObjects\DivinationResult;
use RuntimeException;

class Divination implements DivinationInterface
{
    public function __construct(
        private OracleInterface $oracle,
        private HexagramRepositoryInterface $repository,
    ) {}

    /**
     * @throws Exception
     */
    public function divine(): DivinationResult
    {
        $rawLines    = $this->oracle->cast();
        $transformed = (new LineTransformer())->transform($rawLines);
        $recognizer  = new HexagramRecognizer();

        $primaryNumber   = $recognizer->recognize($transformed['primary']);
        $secondaryNumber = $transformed['secondary'] !== null
            ? $recognizer->recognize($transformed['secondary'])
            : null;

        $primary = $this->repository->findById($primaryNumber)
            ?? throw new RuntimeException("Hexagram #$primaryNumber not found in repository.");

        $secondary = $secondaryNumber !== null
            ? $this->repository->findById($secondaryNumber)
            : null;

        return new DivinationResult($primary, $secondary);
    }
}
