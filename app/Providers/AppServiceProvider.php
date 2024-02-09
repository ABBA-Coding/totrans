<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::directive('priceFormat', function($number) {
            return "<?php echo number_format($number, 0,',',' ') ?>";
        });

        Blade::directive('phone', function ($string){
            return "<?php echo preg_replace('~[^0-9]+~','',$string) ?>";
        });
    }
}
