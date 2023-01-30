<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
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
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        Blade::directive('currency', function ($expression) {
            return "Rp. <?php echo number_format((float)$expression,0,',','.'); ?>";
        });
        Blade::directive('currency2', function ($expression) {
            return "<?php echo number_format((float)$expression,0,',','.'); ?>";
        });

        Blade::directive('currency3', function ($expression) {
            return "<?php echo number_format((float)$expression,3,',','.'); ?>";
        });
        Blade::directive('tkdn', function ($expression) {
            return "<?php echo str_replace('.',',', $expression); ?>";
        });
        Blade::directive('currencytkdn', function ($expression) {
            return "<?php
            if ($expression == number_format((float)$expression,0,',','.')){
                echo number_format((float)$expression,0,',','.');
            } else {
                echo number_format((float)$expression,2,',','.');
            }


            ?>";
        });

        Blade::directive('currency4', function ($expression) {
            return "<?php
            if ($expression == number_format((int)$expression,0,',','.')){
                echo number_format((int)$expression,0,',','.');
            } elseif ($expression == number_format((float)$expression,1,',','.')){
                echo number_format((float)$expression,1,',','.');
            } elseif ($expression == number_format((float)$expression,2,',','.')){
                echo number_format((float)$expression,2,',','.');
            } else {
                echo number_format((float)$expression,3,',','.');
            }

            ?>";
        });


        Paginator::useBootstrap();



    }
}
