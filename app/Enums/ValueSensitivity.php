<?php

namespace App\Enums;

class ValueSensitivity
{
    const COST_CONSCIOUS    = 'Cost-conscious';
    const BALANCED          = 'Balanced';
    const QUALITY_CONSCIOUS = 'Quality-conscious';

    public static function all(): array
    {
        return [
            self::COST_CONSCIOUS,
            self::BALANCED,
            self::QUALITY_CONSCIOUS,
        ];
    }
}
