<?php

namespace App\Providers;

use App\Events\NewUserRegistered;
use App\Events\UserPayment;
use App\Events\UserPlanChange;
use App\Listeners\UserPaymentAdminNotifications;
use App\Listeners\UserPlanChangeAdminNotifications;
use App\Listeners\UserRegisterAdminNotifications;
use App\Listeners\RegisterNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NewUserRegistered::class =>[
            RegisterNotification::class,
            UserRegisterAdminNotifications::class
        ],
        UserPayment::class=>[
            UserPaymentAdminNotifications::class
        ],
        UserPlanChange::class=>
        [
            UserPlanChangeAdminNotifications::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
