<?php

namespace App\Listeners;

use App\Events\UserPlanChange;
use App\Models\AdminNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserPlanChangeAdminNotifications
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserPlanChange $event): void
    {
        $username=$event->username;
        $plan=$event->plan;
        $message=['message'=>'Пользователь '.$username.' изменил тариф на '.$plan];

        AdminNotification::create($message);
    }
}
