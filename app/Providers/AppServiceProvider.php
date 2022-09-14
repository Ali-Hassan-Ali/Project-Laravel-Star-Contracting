<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        
        Schema::defaultStringLength(191);

        ResponseFactory::macro('api', function ($data = null, $error = false, $message = 'ok', $status = 200) {
            return response()->json([
                'status'  => $status,
                'error'   => $error, //1 or 0
                'message' => $message,
                'data'    => $data,
            ]);
        });

    }//end of boot

}//end of class
