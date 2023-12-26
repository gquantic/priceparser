<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    public function upgrade($plan)
    {
        if (Auth::user()->balance >= config('plans.prices')[$plan]) {
            Auth::user()->balanceMinus(config('plans.prices')[$plan]);
            Auth::user()->plan = $plan;

            Auth::user()->active_to = Carbon::now()->addDays(31)->format('Y-m-d H:i:s');

            Auth::user()->save();

            return redirect()->back()->with('success', 'Тариф успешно изменён');
        } else {
            return redirect()->back()->with('error', 'Недостаточно средств на балансе!');
        }
    }
}
