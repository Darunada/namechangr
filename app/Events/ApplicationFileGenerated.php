<?php

namespace App\Events;

use App\Models\Application\Application;
use App\Models\Application\File;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ApplicationFileGenerated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var File
     */
    public $file;

    /**
     * @var Application
     */
    public $application;

    /**
     * Create a new event instance.
     *
     * @param File $file
     * @param Application $application
     */
    public function __construct(File $file, Application $application)
    {
        $this->application = $application;
        $this->file = $file;
    }
}
