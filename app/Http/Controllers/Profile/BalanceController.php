<?php

namespace App\Http\Controllers\Profile;

use App\Events\UserPayment;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\PayTransaction;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    public function show()
    {
        $plan=Product::query()->where('title','=',auth()->user()->plan)->select('title')->first();
        //dd($plan);
        return view('balance.view', compact(['plan']));
    }

    public function edit()
    {
        return view('balance.edit');
    }

    public function update()
    {
        $data=request()->all();
        $pay_data=['user_id'=>$data['user_id'], 'payment'=>$data['deposit']];

        Auth::user()->balancePay($data['deposit']);
        Auth::user()->save();

        PayTransaction::create($pay_data);

        event(new UserPayment($data['user_name'], $data['deposit']));

        return redirect()->route('my.balance.edit');
    }
}
