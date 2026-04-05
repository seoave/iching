<?php

namespace Iching\Core\Infrastructure\Repository;

use Iching\Core\Contracts\HexagramRepositoryInterface;
use Iching\Core\Domain\ValueObjects\Hexagram;

class FileHexagramRepository implements HexagramRepositoryInterface
{
    private string $storageDir;

    public function __construct(?string $storageDir = null)
    {
        $this->storageDir = $storageDir ?? __DIR__ . '/../../storage/hexagrams';
    }

    public function findById(int $id): ?Hexagram
    {
        $path = rtrim($this->storageDir, '/') . '/' . $id . '.php';

        if (!file_exists($path)) {
            return null;
        }

        $data = include $path;

        return new Hexagram(
            number:         $data['id'],
            name:           $data['name'],
            description:    $data['description'],
            keywords:       $data['keywords'],
            interpretation: $data['interpretation'],
            worlds:         $data['worlds']    ?? '',
            potential:      $data['potential'] ?? '',
        );
    }
}
