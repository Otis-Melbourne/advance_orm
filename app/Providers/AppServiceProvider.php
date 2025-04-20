<?php

namespace App\Providers;

use App\Events\RegistrationEvent;
use App\Listeners\RegistrationListener;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            RegistrationEvent::class,
            RegistrationListener::class,
        );
    }
}
