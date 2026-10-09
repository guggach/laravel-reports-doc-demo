<?php

namespace App\Providers;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Use spatie/laravel-pdf with its "chrome" driver (pure PHP + the
        // Chromium binary that Playwright already installed). In production the
        // driver and binary are configured via config/laravel-pdf.php.
        $binary = env('LARAVEL_PDF_CHROME_BINARY') ?: $this->playwrightChromium();

        if (is_string($binary) && $binary !== '') {
            config([
                'laravel-pdf.driver' => 'chrome',
                'laravel-pdf.chrome.chrome_binary' => $binary,
                'laravel-pdf.chrome.no_sandbox' => true,
            ]);
        }
    }

    private function playwrightChromium(): ?string
    {
        $home = getenv('HOME');

        if ($home === false || $home === '') {
            return null;
        }

        $matches = glob($home.'/.cache/ms-playwright/chromium-*/chrome-linux64/chrome') ?: [];
        rsort($matches);

        return $matches[0] ?? null;
    }
}
