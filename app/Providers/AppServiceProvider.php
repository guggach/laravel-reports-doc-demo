<?php

namespace App\Providers;

use App\Reports\Pdf\PlaywrightHtmlToPdf;
use Guggach\Reports\Contracts\HtmlToPdf;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(HtmlToPdf::class, PlaywrightHtmlToPdf::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
