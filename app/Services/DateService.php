<?php

namespace App\Services;

use Carbon\Carbon;

/**
 * Class DateService
 * @package App\Services
 */
class DateService
{
    /**
     * Return the number of day of the week (1 = Monday, 7 = Sunday).
     *
     * @param $date
     * @return int
     */
    public function numberOfDayOfWeek($date)
    {
        return Carbon::parse($date)->format('N');
    }

    /**
     * @param $date
     * @param $daysToSubtract
     * @return static
     */
    public function subtractDaysFromDate($date, $daysToSubtract)
    {
        return Carbon::parse($date)->subDays($daysToSubtract);
    }

}
