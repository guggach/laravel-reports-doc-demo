<?php

namespace App\Providers;

use App\Http\Middleware\NoIndex;
use App\Http\Middleware\ServePrebuiltPdf;
use App\Support\ChromiumBinary;
use Guggach\Reports\Contracts\HtmlToPdf;
use Guggach\Reports\Renderers\SpatieLaravelPdfConverter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(HtmlToPdf::class, SpatieLaravelPdfConverter::class);

        // The package reads this list in its own boot() method. Every provider
        // is registered before any boot() runs, so setting the config here is
        // safe and keeps the package defaults intact. NoIndex wraps the
        // prebuilt PDF middleware so the header is also set on file responses.
        config([
            'reports.routes.middleware' => [
                'web',
                NoIndex::class,
                ServePrebuiltPdf::class,
            ],
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Use spatie/laravel-pdf with its "chrome" driver (pure PHP + the
        // Chromium binary that Playwright already installed). In production the
        // driver and binary are configured via config/laravel-pdf.php.
        $binary = ChromiumBinary::path();

        if (is_string($binary) && $binary !== '') {
            config([
                'laravel-pdf.driver' => 'chrome',
                'laravel-pdf.chrome.chrome_binary' => $binary,
                'laravel-pdf.chrome.no_sandbox' => true,
            ]);
        }
    }
}
