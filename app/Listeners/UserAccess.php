<?php

namespace App\Listeners;

use App\Events\UserAccess as UserAccessEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserAccess extends ListenerBase
{

    /**
     * Handle the event.
     *
     * @param  UserAccessEvent  $event
     * @return void
     */
    public function handle(UserAccessEvent $event)
    {
         $this->statut->setStatut();
    }
}
