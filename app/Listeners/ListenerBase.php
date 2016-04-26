<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\Statut;

class ListenerBase
{

    protected $statut;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Statut $statut)
    {
        $this->statut = $statut;
    }

}
