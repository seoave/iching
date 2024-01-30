<?php

/**
 * 6 old Ying
 * 7 Yang
 * 8 Ying
 * 9 old Yang
 */

namespace App;

class Constants
{
    public const STICKS = 49;
    public const OLD_YIN = 6;
    public const OLD_YANG = 9;
    public const APP_DIR = __DIR__;

    /**
     * From Ying to Yang.
     */
    public const THREEGRAMS = [
        1 => [7, 7, 7], // Heaven, Energy, Creativity
        2 => [7, 7, 8], // Wind
        3 => [7, 8, 7], // Flame
        4 => [7, 8, 8], // Mountain
        5 => [8, 7, 7], // Lake
        6 => [8, 7, 8], // Water
        7 => [8, 8, 7], // Thunder
        8 => [8, 8, 8], // Earth
    ];
}
