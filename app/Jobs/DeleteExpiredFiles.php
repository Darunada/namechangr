<?php

namespace App\Jobs;

use App\Models\Application\File AS ApplicationFile;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DeleteExpiredFiles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $applicationFiles = ApplicationFile::where('expired', '<=', Carbon::now())->chunk(10, function($files) {
            foreach($files AS $file) {
                job(new DeleteApplicationFile($file));
            }
        });
    }
}
