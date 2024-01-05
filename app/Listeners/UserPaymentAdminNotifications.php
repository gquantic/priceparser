<?php

namespace App\Listeners;

use App\Events\UserPayment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\AdminNotification;


class UserPaymentAdminNotifications
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
    public function handle(UserPayment $event): void
    {
        $username=$event->username;
        $payment=$event->payment;

        $message=['message'=>'Пользователь '.$username.' пополнил баланс на '.$payment.' рублей'];
        AdminNotification::create($message);
    }
}
