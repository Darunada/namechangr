<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;

class GetPassportKeys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'passport:fetch-keys';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch passport keys from the configured storage location and put them where they gotta go';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $privateKey = Storage::drive('private')->get('oauth-private.key');
            file_put_contents(storage_path('oauth-private.key'), $privateKey);

            $publicKey = Storage::drive('private')->get('oauth-public.key');
            file_put_contents(storage_path('oauth-public.key'), $publicKey);

            $this->info('Keys fetched successfully');
        } catch (Exception $e) {
            $this->error(
                'Unable to fetch keys!  Do you have your config set for s3?  You can generate your own using `php artisan passport:keys`'
            );
        }
    }
}
