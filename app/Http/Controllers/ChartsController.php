<?php

namespace App\Http\Controllers;

use App\Services\ChartsService;
use Illuminate\Http\Request;

class ChartsController extends Controller
{
    public function index(ChartsService $chartsService)
    {
    	// echo cohortName('2019-11-04');
        return view('charts')->with('charts', $chartsService->retentionCurveData());
    }
}
