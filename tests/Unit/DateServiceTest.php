<?php

namespace Tests\Unit;

use App\Services\DateService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DateServiceTest extends TestCase
{
    /** @var DateService */
    protected $dateService;

    public function setUp()
    {
        parent::setUp();

        $this->dateService = $this->app->make('date');
    }

    /**
     * Test the day subtract method
     *
     * @return void
     */
    public function testDaySubtractTest()
    {
        $givenDate = '2019-10-27';
        $expectedDate = new \DateTime('2019-10-24');
        $daysToSubtract = 3;

        $this->assertEquals($expectedDate, $this->dateService->subtractDaysFromDate($givenDate, $daysToSubtract));
    }

    public function testMondayDateOfTheWeekForDateTest()
    {
        $monday = '2019-07-01';
        $wednesday = '2019-07-03';
        $friday = '2019-07-05';

        $this->assertEquals($monday, $this->dateService->calculateFirstdayOfTheWeekOfAnyDate($monday));
        $this->assertEquals($monday, $this->dateService->calculateFirstdayOfTheWeekOfAnyDate($wednesday));
        $this->assertEquals($monday, $this->dateService->calculateFirstdayOfTheWeekOfAnyDate($friday));
    }
}
