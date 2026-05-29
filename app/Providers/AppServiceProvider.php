<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // HTTPS is detected automatically from the X-Forwarded-Proto header
        // via the trusted proxies configured in bootstrap/app.php (works for
        // ngrok/production). Forcing the scheme here breaks direct local HTTP
        // access (e.g. `php artisan serve`), so we don't force it.
    }
}
