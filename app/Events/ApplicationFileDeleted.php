<?php

namespace App\Events;

use App\Models\Application\Application;
use App\Models\Application\File AS ApplicationFile;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ApplicationFileDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var ApplicationFile
     */
    public $file;

    /**
     * Create a new event instance.
     *
     * @param ApplicationFile $file
     */
    public function __construct(ApplicationFile $file)
    {
        $this->file = $file;
    }
}
