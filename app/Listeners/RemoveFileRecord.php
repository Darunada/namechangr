<?php

namespace App\Listeners;

use App\Events\ApplicationFileDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Application\File AS ApplicationFile;


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
     * @param  ApplicationFileDeleted  $event
     * @return void
     */
    public function handle(ApplicationFileDeleted $event)
    {
        $event->file->delete();
    }
}
