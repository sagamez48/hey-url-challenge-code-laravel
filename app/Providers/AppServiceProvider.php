<?php namespace App\Providers;

use App\Url;
use App\UrlService;
use Hashids\Hashids;
use Illuminate\Support\ServiceProvider;
use Jenssegers\Agent\Agent;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UrlService::class, function ($app) {
            return new UrlService(
                $app['browser.agent'],
                $app['hashids'],
                new Url()
            );
        });

        $this->app->singleton('browser.agent', function ($app) {
            return new Agent();
        });

        $this->app->singleton('hashids', function ($app) {
            return new Hashids('', 5);
        });
    }
}
