<?php

namespace App\Listeners;

use App\Events\NewUserRegistered;
use App\Models\AdminNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;


class UserRegisterAdminNotifications
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
    public function handle(NewUserRegistered $event): void
    {
        $username=$event->username;
        $message=['message'=>'Зарегистрировался новый пользователь “'.$username.'”'];

        AdminNotification::create($message);
    }
}
