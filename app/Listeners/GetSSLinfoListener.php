<?php

namespace App\Listeners;

use App\Events\ProjectCreatedEvent;
use App\Jobs\GetSSLInfoJob;

class GetSSLinfoListener
{
    public function __construct()
    {
        //
    }

    public function handle(ProjectCreatedEvent $event)
    {

       $certInfo = GetSSLInfoJob::dispatch($event->project);

    }
}