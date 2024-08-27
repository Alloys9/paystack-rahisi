<?php

namespace Alloys9\PaystackRahisi;

use Illuminate\Support\ServiceProvider;
use Alloys9\PaystackRahisi\Console\Commands\InstallPaystackRahisiPackage;

class PaystackServiceProvider extends ServiceProvider
{
    public function register()
    {


    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->commands([
                InstallPaystackRahisiPackage::class,
            ]);
        }

    }
}
