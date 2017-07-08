<?php

namespace App\Jobs;

use App\Contracts\Generators\Application AS ApplicationGenerator;
use App\Events\FileGenerated;
use App\Models\Application\Application;
use App\Models\Application\File;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GenerateApplication implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Application
     */
    protected $application;

    /**
     * @var ApplicationGenerator
     */
    protected $applicationGenerator;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $broadcastOn;

    /**
     * Create a new job instance.
     *
     * @param Application $application
     * @param ApplicationGenerator $generator
     * @param null|string $type pdf|html|docx
     * @param null|string $broadcastOn
     * @internal param string $type
     */
    public function __construct(Application $application, ApplicationGenerator $generator, $type=null, $broadcastOn = null)
    {
        $this->application = $application;
        $this->applicationGenerator = $generator;
        $this->type = $type;
        $this->broadcastOn = $broadcastOn;
    }

    /**
     * Execute the job.
     * @return void
     */
    public function handle()
    {
        /** @var File $applicationFile */
        $applicationFile = $this->runGenerator();

        /**
         * TODO: evaluate this
         */
        if($this->broadcastOn) {
            $applicationFile->channel = $this->broadcastOn;
            $applicationFile->save();
        }

        event(new FileGenerated($applicationFile, $this->broadcastOn));
    }

    protected function runGenerator() {
        $applicationFile = null;
        if(method_exists($this->applicationGenerator, $this->type)) {
            $applicationFile = $this->applicationGenerator->{$this->type}($this->application);
        } else {
            $applicationFile = $this->applicationGenerator->generate($this->application, $this->type);
        }

        return $applicationFile;
    }
}
