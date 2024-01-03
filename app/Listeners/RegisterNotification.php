<?php

namespace App\Listeners;

use App\Events\NewUserRegistered;
use App\Mail\User\RegisterMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class RegisterNotification
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
        $email=$event->email;
        Mail::to($email)->send(new RegisterMail());

    }
}
