<?php

namespace App\Listeners;

use App\Events\ServiceCreated;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyServiceCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ServiceCreated  $event
     * @return void
     */
    public function handle(ServiceCreated $event)
    {
        $users = User::all();

        foreach($users as $user) {
            send($user->device_token, $event->service->title, $event->service->desc, 'mail', $event->service);
        }
    }
}
