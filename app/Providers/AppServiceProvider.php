<?php

namespace App\Providers;

use App\Http\Controllers\V1\InternetServiceProviderController;
use App\Interfaces\CalculatorInterface;
use App\Services\InternetServiceProvider\Mpt;
use App\Services\InternetServiceProvider\Ooredoo;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('CalculatorInterface', Mpt::class, 'mpt');
        $this->app->bind('CalculatorInterface', Ooredoo::class, 'mpt');
        // $wifiCalculator = $this->app->make('CalculatorInterface', ['alias' => 'mpt']);
        // Alias WifiCalculator as "wifi"
        $this->app->alias(Mpt::class, 'mpt');
        $this->app->alias(Ooredoo::class, 'ooredoo');
        // $this->app->bind('CalculatorInterface', Ooredoo::class, 'ooredoo');

        // $this->app->bind(CalculatorInterface::class, Mpt::class);
        // $this->app->bind(CalculatorInterface::class, Ooredoo::class);

        // $this->app->when(Mpt::class)
        //     ->needs(CalculatorInterface::class)
        //     ->give(function () {
        //         return new Mpt();
        //     });

        // $this->app->when(Ooredoo::class)
        //     ->needs(CalculatorInterface::class)
        //     ->give(function () {
        //         return new Ooredoo();
        //     });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * Custom Validator
         */
        Validator::extend('checkspecialcharacter', function ($attribute, $value, $parameters, $validator) {
            $check = true;
            // $sp='"%*;<>?^`{|}~\\\'#=&';
            $sp = config('constant.special_character');

            if (preg_match("/[" . $sp . "]/", $value)) {
                $check = false;
            }

            return $check;
        });

        Validator::extend('alphabert', function ($attribute, $value, $parameters, $validator) {
            if (!ctype_alpha($value)) {
                return false;
            }

            return true;
        });
    }
}
