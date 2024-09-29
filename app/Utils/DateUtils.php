<?php

namespace App\Utils;

class DateUtils
{
    public function convertDateFormat(?string $date): ?string
    {
        if ($date) {
            $dateTime = \DateTime::createFromFormat('d-m-Y', $date);
            return $dateTime !== false ? $dateTime->format('Y-m-d') : null;
        }
        return null;
    }
}
