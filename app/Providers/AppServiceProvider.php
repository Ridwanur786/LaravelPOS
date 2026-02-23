<?php

namespace App\Providers;

use Illuminate\Http\Response;
use App\Services\ProductService;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\App\Services\ProductService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        ResponseFactory::macro('ajaxSuccess', function (mixed $data = null, string $message = 'product created Successfully', int $status = 200) {
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'data' => $data
            ], $status);
        });

    

        //Paginator::useBootstrap();
    }
}
