<?php

namespace App\Events;

use App\Models\Application\File as ApplicationFile;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

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
