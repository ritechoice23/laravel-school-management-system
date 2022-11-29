<?php

namespace App\Providers;

use App\Models\Setting;
use App\Repositories\SettingRepo;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //        set a global settings
        $this->app->singleton('settings', function () {
            $settings = Setting::all();
            $fls = $settings->flatMap(function($settings){
                return [$settings->type => $settings->description];
            });
            return $fls;
        });

        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
        //
    }
}
