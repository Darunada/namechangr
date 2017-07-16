<?php

namespace App\Jobs;

use App\Events\ApplicationFileDeleted;
use App\Models\Application\File AS ApplicationFile;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Storage;

class DeleteApplicationFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var ApplicationFile
     */
    protected $applicationFile;

    /**
     * Create a new job instance.
     *
     * @param ApplicationFile $applicationFile
     */
    public function __construct(ApplicationFile $applicationFile)
    {
        $this->applicationFile = $applicationFile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Storage::delete($this->applicationFile->path);

        /**
         * Spawn an event to hook later
         */
        event(new ApplicationFileDeleted($this->applicationFile));
    }
}
