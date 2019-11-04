<?php

namespace App\Repositories;

use Carbon\Carbon;

class Users
{
    public function groupByWeek()
    {
        return \DB::table('users')->select('onboarding_percentage', 'created_at')->get()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('W');
        });
    }
}
