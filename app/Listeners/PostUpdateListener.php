<?php

namespace App\Listeners;

use App\Jobs\NotifyAdmins;
use \App\Events\PostWasUpdated;

class PostUpdateListener
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
     * @param  PostWasUpdated  $event
     * @return void
     */
    public function handle(PostWasUpdated $event)
    {
        logger("PostWasUpdated");
        NotifyAdmins::dispatch($event->post);
    }
}
