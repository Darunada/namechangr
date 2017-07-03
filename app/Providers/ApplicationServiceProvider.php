<?php

namespace App\Providers;

use App\Models\Application;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\ServiceProvider;

class ApplicationServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('App\Models\Application', function($app) {
            $request = $this->app['request'];
            $applicationId = $request->route('application');

            try {
                $application = Application::findOrFail($applicationId);
            } catch(ModelNotFoundException $e) {
                $application = $request->session()->get('activeApplication');
            }

            return $application;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Application::class];
    }
}
