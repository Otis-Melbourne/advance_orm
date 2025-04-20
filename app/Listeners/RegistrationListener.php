<?php

namespace App\Listeners;

use App\Mail\RegistrationMail;
use App\Events\RegistrationEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrationListener
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
    public function handle(RegistrationEvent $event): void
    {
        Mail::to($event->user->email)->queue(new RegistrationMail($event->user));
    }
}
