<?php

namespace App\Services;
use App\Repositories\Users;

/**
 * Class ChartsService
 * @package App\Services
 */
class ChartsService
{
    /**
     * @var Users
     */
    public $users;

    /**
     * @var DateService
     */
    protected $dateService;

    /**
     * ChartsService constructor.
     *
     * @param Users $users
     * @param DateService $dateService
     */
    public function __construct(Users $users, DateService $dateService)
    {
        $this->users = $users;
        $this->dateService = $dateService;
    }

    /**
     * The cohort date (in the graph legend) should always be a Monday, since we can't expect
     * that the given data provides registrations from every single day.
     *
     * @param string $date
     * @return string
     */
    private function cohortName($date)
    {
        return resolve('App\Services\DateService')->calculateFirstdayOfTheWeekOfAnyDate($date);
    }

    /**
     * Data for a single cohort.
     *
     * @param $weekUsers
     * @return array
     */
    public function singleCohortData($weekUsers)
    {
        return [
            'name' => $this->cohortName($weekUsers->first()->created_at),
            'data' => $this->mapPercentageOfUsersToAllOnboardingPercentages($weekUsers)
        ];
    }

    /**
     * Calculates the percentage of users that are at (or beyond) the given onboarding percentage.
     *
     * @param $usersInCohort
     * @return array
     */
    public function mapPercentageOfUsersToAllOnboardingPercentages($usersInCohort)
    {
        $onboardingPercentagesOfUsers = $usersInCohort->pluck('onboarding_percentage')->all();
        $onboardingRange = range(0, 100);

        $mapOnboardingPercentageToUserPercentage = function($onboardingPercentage) use ($usersInCohort, $onboardingPercentagesOfUsers) {
            $userCount = $this->getUserCountOfSingleOnboardingPercentage($onboardingPercentage, $onboardingPercentagesOfUsers);

            return $userCount / count($usersInCohort) * 100;
        };

        return array_map($mapOnboardingPercentageToUserPercentage, $onboardingRange);
    }

    /**
     * Get the amount of users that are at (or beyond) the given onboarding percentage.
     *
     * @param $onboardingPercentage
     * @param $onboardingPercentagesOfUsers
     * @return int
     */
    public function getUserCountOfSingleOnboardingPercentage($onboardingPercentage, $onboardingPercentagesOfUsers)
    {
        return count(array_filter($onboardingPercentagesOfUsers, function($onboardingPercentageOfUser) use ($onboardingPercentage) {
            return $onboardingPercentageOfUser >= $onboardingPercentage;
        }));
    }

    /**
     * Data for a single cohort.
     *
     * @param $weekUsers
     * @return array
     */
    public function singleCohortData($weekUsers)
    {
        return [
            'name' => $this->cohortName($weekUsers->first()->created_at),
            'data' => $this->mapPercentageOfUsersToAllOnboardingPercentages($weekUsers)
        ];
    }
    /**
     * Loop through the weeks/cohorts to create the required structure for the frontend.
     *
     * @param $usersByWeek
     * @return array
     */
    public function cohortsWeeklyData($usersByWeek)
    {
        $data = [];

        foreach ($usersByWeek as $weekUsers) {
            $data[] = $this->singleCohortData($weekUsers);
        }

        return $data;
    }

    /**
     * Returns the retention curves data.
     *
     * @return array
     */
    public function getRetentionCurvesData()
    {
        return $this->cohortsWeeklyData($this->users->groupedByWeek());
    }
}
