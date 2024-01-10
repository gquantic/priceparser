<?php

namespace App\Http\Controllers;

use App\Services\Plan\PlanService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected PlanService $PlanService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PlanService $PlanService)
    {
        $this->middleware('auth');
        $this->PlanService=$PlanService;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->PlanService->check_limit();
        return view('home');
    }
}
