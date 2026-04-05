<?php

namespace Iching\Core\Domain\Services;

use Iching\Core\Constants;

class LineTransformer
{
    /**
     * Transform 6 raw line values into primary and secondary hexagram line arrays.
     * If no changing lines exist, secondary is null.
     *
     * @param  int[] $rawLines
     * @return array{primary: int[], secondary: int[]|null}
     */
    public function transform(array $rawLines): array
    {
        if (!$this->hasChangingLines($rawLines)) {
            return ['primary' => $rawLines, 'secondary' => null];
        }

        return [
            'primary'   => $this->normalizePrimary($rawLines),
            'secondary' => $this->buildSecondary($rawLines),
        ];
    }

    private function hasChangingLines(array $lines): bool
    {
        return in_array(Constants::OLD_YIN, $lines, true)
            || in_array(Constants::OLD_YANG, $lines, true);
    }

    /**
     * Bring changing lines to their stable state for the primary hexagram.
     * Old Yang (9) → Yang (7), Old Yin (6) → Yin (8).
     *
     * @param  int[] $lines
     * @return int[]
     */
    private function normalizePrimary(array $lines): array
    {
        return array_map(fn(int $v) => match ($v) {
            Constants::OLD_YIN  => 8,
            Constants::OLD_YANG => 7,
            default             => $v,
        }, $lines);
    }

    /**
     * Flip changing lines for the secondary hexagram.
     * Old Yang (9) → Yin (8), Old Yin (6) → Yang (7).
     *
     * @param  int[] $lines
     * @return int[]
     */
    private function buildSecondary(array $lines): array
    {
        return array_map(fn(int $v) => match ($v) {
            Constants::OLD_YIN  => 7,
            Constants::OLD_YANG => 8,
            default             => $v,
        }, $lines);
    }
}
