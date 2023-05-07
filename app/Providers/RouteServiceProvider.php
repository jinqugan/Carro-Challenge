<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';
    /** @var string $apiNamespace */
    protected $apiNamespace = 'App\Http\Controllers\Api';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        // Route::group([
        //     'middleware' => ['api', 'api_version:v1'],
        //     'namespace'  => "{$this->apiNamespace}\V1",
        //     'prefix'     => 'api/v1',
        // ], function ($router) {
        //     require base_path('routes/api_v1.php');
        // });

        $this->routes(function () {
            Route::group([
                'middleware' => ['api', 'api_version:v1'],
                'namespace'  => "{$this->apiNamespace}\V1",
                'prefix'     => 'api/v1',
            ], function ($router) {
                require base_path('routes/api_v1.php');
            });

            // Route::middleware('api')
            //     ->prefix('api')
            //     ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(config('constant.rate_limit_per_minute'))->by($request->user()?->id ?: $request->ip());
        });
    }
}
