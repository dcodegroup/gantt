<?php

namespace DcodeGroup\Gantt;

use Illuminate\Support\ServiceProvider;

class GanttServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/assets/css' => public_path('vendor/DcodeGroup/gantt/css'),
        ], 'DcodeGroup');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
