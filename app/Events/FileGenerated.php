<?php

namespace App\Events;

use App\Models\Application\File;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class FileGenerated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var File
     */
    public $file;

    /**
     * @var string
     */
    protected $channel;

    /**
     * Create a new event instance.
     *
     * @param File $file
     * @param $channel
     */
    public function __construct(File $file, $channel)
    {
        $this->file = $file;
        $this->channel = $channel;
    }

    /**
     * Determine if this event should broadcast.
     *
     * @return bool
     */
    public function broadcastWhen()
    {
        return $this->channel != null;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        /**
            .listen('.application.[channel]', function (e) {
                ....
            });
         */
        return new PrivateChannel("application.$this->channel");
    }
}
