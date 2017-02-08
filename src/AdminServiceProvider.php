<?php

namespace BenjaminChen\Admin;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'admin.auth'        => \BenjaminChen\Admin\Middleware\Authenticate::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'admin' => [
            'admin.auth',
        ],
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'adminPack');
        $this->loadTranslationsFrom(__DIR__.'/lang', 'adminPack');
        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/adminPack'),
        ], 'public');
        $this->publishes([
            __DIR__.'/migrations/' => database_path('migrations')
        ], 'migrations');
        $this->publishes([
            __DIR__.'/config/' => config_path()
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/routes.php';
        $this->registerRouteMiddleware();
        $this->app->make('BenjaminChen\Admin\Controllers\AdminController');
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('BHelper', 'BenjaminChen\Admin\Classes\Helper');
        $this->app->booting(function () {
            config([
                'auth.guards.admin.driver'    => 'session',
                'auth.guards.admin.provider'  => 'admin',
                'auth.providers.admin.driver' => 'eloquent',
                'auth.providers.admin.model'  => 'BenjaminChen\Admin\AdminUser',
            ]);
        });
    }

    /**
     * Register the route middleware.
     *
     * @return void
     */
    protected function registerRouteMiddleware()
    {
        // register route middleware.
        foreach ($this->routeMiddleware as $key => $middleware) {
            app('router')->middleware($key, $middleware);
        }
        // register middleware group.
        foreach ($this->middlewareGroups as $key => $middleware) {
            app('router')->middlewareGroup($key, $middleware);
        }
    }
}
