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
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/admin/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    protected $namespace = 'App\\Http\\Controllers';
    protected $adminNamespace = 'App\\Http\\Controllers\\Admin';
    protected $adminChartNamespace = 'App\\Http\\Controllers\\Admin\\Chart';
    protected $adminHomeNamespace = 'App\\Http\\Controllers\\Admin\\Home';
    protected $adminReportNamespace = 'App\\Http\\Controllers\\Admin\\Report';
    protected $apiNamespace = 'App\\Http\\Controllers\\Api';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->apiNamespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                ->namespace($this->adminNamespace)
                ->group(base_path('routes/admin/web.php'));

            Route::middleware('web')
                ->namespace($this->adminChartNamespace)
                ->group(base_path('routes/admin/chart.php'));

            Route::middleware('web')
                ->namespace($this->adminHomeNamespace)
                ->group(base_path('routes/admin/home.php'));

            Route::middleware('web')
                ->namespace($this->adminReportNamespace)
                ->group(base_path('routes/admin/report.php'));

        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

}
