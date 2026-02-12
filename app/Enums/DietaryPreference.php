<?php

namespace App\Enums;

class DietaryPreference
{
    const VEGETARIAN     = 'Vegetarian';
    const EGGETARIAN     = 'Eggetarian';
    const NON_VEGETARIAN = 'Non-Vegetarian';

    public static function all(): array
    {
        return [
            self::VEGETARIAN,
            self::EGGETARIAN,
            self::NON_VEGETARIAN,
        ];
    }
}
