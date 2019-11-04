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

    /**
     * Calculate  first day of the week 
     *
     * @param $date
     * @return DateService
     */
    public function calculateFirstdayOfTheWeekOfAnyDate($date)
    {
        $daysToSubtract = $this->numberOfDayOfWeek($date) - 1; // 1 = Monday

        return $cohortDate = $this->subtractDaysFromDate($date, $daysToSubtract)->format('Y-m-d');
    }

}
