<?php

namespace App\Enums;

class WeekDay
{
    const SUNDAY    = 1;
    const MONDAY    = 2;
    const TUESDAY   = 3;
    const WEDNESDAY = 4;
    const THURSDAY  = 5;
    const FRIDAY    = 6;
    const SATURDAY  = 7;

    public static function all(): array
    {
        return [
            self::SUNDAY,
            self::MONDAY,
            self::TUESDAY,
            self::WEDNESDAY,
            self::THURSDAY,
            self::FRIDAY,
            self::SATURDAY,
        ];
    }
}
