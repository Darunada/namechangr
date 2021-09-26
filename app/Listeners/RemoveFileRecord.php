<?php

namespace App\Listeners;

use App\Events\ApplicationFileDeleted;


class RemoveFileRecord
{

    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param ApplicationFileDeleted $event
     * @return void
     */
    public function handle(ApplicationFileDeleted $event)
    {
        $event->file->delete();
    }
}
