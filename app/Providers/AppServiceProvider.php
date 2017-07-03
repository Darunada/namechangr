<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // fix for mysql
        Schema::defaultStringLength(191);

        /**
         * Adds $controller and $action to views
         * https://stackoverflow.com/questions/29549660/get-laravel-5-controller-name-in-view
         */
        View::composer('*', function ($view) {
            $route = app('request')->route();
            if($route) {
                $action = $route->getAction();
                $controller = class_basename($action['controller']);
                list($controller, $action) = explode('@', $controller);
                $view->with(compact('controller', 'action'));
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // IDE helper should not be available in production
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
