<?php

namespace App\Providers;

use App\Post;
use App\Observers\PostObserver;
use Illuminate\Support\ServiceProvider;
use \App\Oauth2\Socialite\MSAuthProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        'App\Contracts\EventPusher' =>  'Illuminate\Database\Capsule\RedisEventPusher'
    ];

    public $bindings = [
        'App\Contracts\Entity' =>  'Illuminate\Database\Capsule\Eloquent'
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Post::observe(PostObserver::class);
        $this->bootMSAuth();

        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function bootMSAuth()
    {
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'bitsense_auth',
            function ($app) use ($socialite) {
                $config = $app['config']['services.bitsense_auth'];
                return $socialite->buildProvider(MSAuthProvider::class, $config);
            }
        );
    }
}
