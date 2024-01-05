<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserPayment;
use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\PayTransaction;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function show()
    {
        $notifications=AdminNotification::query()->limit(4)->get();
        return view('admin.index', compact(['notifications']));
    }

    public function users()
    {
        $users=User::query()->where('is_admin','!=','1')->get();
        $notifications=AdminNotification::query()->limit(4)->get();

        return view('admin.users', compact(['users', 'notifications']));
    }

    public function notifications()
    {
        $notifications_all=AdminNotification::all();
        $notifications=AdminNotification::query()->limit(4)->get();

        return view('admin.notifications', compact(['notifications', 'notifications_all']));
    }

}
