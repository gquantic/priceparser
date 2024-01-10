<?php

namespace App\Services\Plan;

use Illuminate\Support\Facades\Auth;


class PlanService
{
    public function check_plan()
    {
        return Auth::user()->plan;
    }

    public function plan_expire_date()
    {
        if(Auth::user()->active_to<=date("Y-m-d"))
        {
            return Auth::user()->active_to;
        }
        else
        {
            return 'expired';
        }
    }
    public function check_plan_expire()
    {
        if(Auth::user()->active_to<=date("Y-m-d"))
            return true;
        else
            return false;
    }
    public function check_limit()
    {
        //если дата изменения > сегодня 00:00:00-> разница
        if(Auth::user()->updated_at>date("d-m-Y 00:00:00"))
        {
                return ['used'=>Auth::user()->today_limit, 'left'=>Auth::user()->daily_limit-Auth::user()->today_limit, 'total'=>Auth::user()->daily_limit];
        }
        //иначе обнуляем
        else
        {
            Auth::user()->today_limit = 0;
            Auth::user()->save();
            return ['used'=>Auth::user()->today_limit, 'left'=>Auth::user()->daily_limit-Auth::user()->today_limit, 'total'=>Auth::user()->daily_limit];
        }
    }

    public function incr_limit()
    {
        //увеличиваем использованные запросы на 1
        $today_limit=Auth::user()->today_limit;
        $today_limit++;

        Auth::user()->today_limit = $today_limit;
        Auth::user()->save();

         return true;
    }

    public function request_available()
    {
        if(check_limit()['left']>0)
            return true;
        else
            return false;
    }
}
