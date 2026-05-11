<?php

namespace App\Providers;

use App\Events\ChangePasswordLog;
use App\Events\StatusChangeLog;
use App\Listeners\StatusChangeLogFired;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Events\UserLoggedIn;
use App\Listeners\UserLoggedInFired;
use App\Events\SmsMail;
use App\Listeners\ChangePasswordLogListener;
use App\Listeners\SmsMailFired;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserLoggedIn::class => [
            UserLoggedInFired::class,
        ],
        SmsMail::class => [
            SmsMailFired::class,
        ],
        StatusChangeLog::class => [
            StatusChangeLogFired::class,
        ],
        CheckFormDate::class => [
            SendCheckFormDateResult::class,
        ],

       ChangePasswordLog::class => [
            ChangePasswordLogListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
