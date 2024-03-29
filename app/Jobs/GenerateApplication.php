<?php

namespace App\Jobs;

use App\Contracts\Generators\ApplicationGenerator;
use App\Events\ApplicationFileGenerated as ApplicationFileGeneratedEvent;
use App\Models\Application\Application;
use App\Models\Application\File;
use App\Notifications\ApplicationFileGenerated as ApplicationFileGeneratedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
     * Create a new job instance.
     *
     * @param Application $application
     * @param ApplicationGenerator $generator
     * @param null|string $type pdf|html|docx
     * @internal param string $type
     */
    public function __construct(Application $application, ApplicationGenerator $generator, $type = null)
    {
        $this->application = $application;
        $this->applicationGenerator = $generator;
        $this->type = $type;
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
         * Notify the user
         */
        $this->application->user->notify(new ApplicationFileGeneratedNotification($applicationFile, $this->application));

        /**
         * Spawn an event to hook later
         */
        event(new ApplicationFileGeneratedEvent($applicationFile, $this->application));
    }

    protected function runGenerator()
    {
        $applicationFile = null;
        if (method_exists($this->applicationGenerator, $this->type)) {
            $applicationFile = $this->applicationGenerator->{$this->type}($this->application);
        } else {
            $applicationFile = $this->applicationGenerator->generate($this->application, $this->type);
        }

        return $applicationFile;
    }
}
