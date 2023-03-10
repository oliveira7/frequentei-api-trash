<?php

namespace App\Enums;

class WeekEnum
{
    public const TYPE_MONDAY = 'monday';
    public const TYPE_TUESDAY = 'tuesday';
    public const TYPE_WEDNESDAY = 'wednesday';
    public const TYPE_THURSDAY = 'thursday';
    public const TYPE_FRIDAY = 'friday';
    public const TYPE_SATURDAY = 'saturday';
    public const TYPE_SUNDAY = 'sunday';

    public static function getTypes(): array
    {
        return [
            self::TYPE_MONDAY,
            self::TYPE_TUESDAY,
            self::TYPE_WEDNESDAY,
            self::TYPE_THURSDAY,
            self::TYPE_FRIDAY,
            self::TYPE_SATURDAY,
            self::TYPE_SUNDAY,
        ];
    }
}
