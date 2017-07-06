<?php

namespace App\Providers;

use App\Models\Application;
use App\Models\Location\State;
use App\User;
use App\UserSocialAccount;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Intouch\LaravelNewrelic\Observers\NewrelicCountingObserver;
use Intouch\LaravelNewrelic\Observers\NewrelicTimingObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @param UrlGenerator $urlGenerator
     * @return void
     */
    public function boot(UrlGenerator $urlGenerator)
    {
        // fix for mysql
        Schema::defaultStringLength(191);

        // force httops in production
        if ($this->app->environment() === 'production') {
            $urlGenerator->forceScheme('https');
        }

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

        User::observe(new NewrelicTimingObserver() );
        User::observe(new NewrelicCountingObserver() );

        UserSocialAccount::observe(new NewrelicTimingObserver() );
        UserSocialAccount::observe(new NewrelicCountingObserver() );

        Application::observe(new NewrelicTimingObserver() );
        Application::observe(new NewrelicCountingObserver() );

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
