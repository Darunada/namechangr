<?php

namespace App\Events;

use App\Models\Application\Application;
use App\Models\Application\File;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

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
