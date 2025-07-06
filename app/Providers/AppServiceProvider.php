<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            
            // Schedule the delete empty comments command to run every minute
            // Note: This should only be triggered manually using php artisan schedule:run
            $schedule->command('comments:delete-empty')
                    ->everyMinute()
                    ->withoutOverlapping()
                    ->runInBackground();
        });
    }
}
