<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->bootOAuth2Socialite();
    }

    private function bootOAuth2Socialite(): void
    {
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'oauth2',
            function ($app) use ($socialite) {
                $config = $app['config']['services.oauth2'];

                return $socialite->buildProvider(OAuth2Provider::class, $config);
            }
        );
    }
}
