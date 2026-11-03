<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Support\DemoAssetPaths;
use Closure;
use Guggach\Reports\Localization\ReportLocale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

/**
 * Serves the prebuilt PDF for the default report state and only falls back to
 * live Chromium rendering when the visitor actually changed a filter.
 *
 * This keeps the expensive path (a Chromium process per request) off the
 * common route: the demo data is static, so the default PDF for every example
 * is generated once by `php artisan demo:pdfs`.
 */
final class ServePrebuiltPdf
{
    /** Live PDF renders allowed per minute and IP. */
    private const int LIVE_RENDERS_PER_MINUTE = 6;

    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->routeIs('reports.pdf')) {
            return $next($request);
        }

        $name = $request->route('name');

        if (! is_string($name) || ! DemoAssetPaths::hasReport($name)) {
            return $next($request);
        }

        if ($this->hasCustomFilters($request)) {
            $this->throttleLiveRendering($request);

            return $next($request);
        }

        $path = DemoAssetPaths::pdfPath($name, $this->locale($request));

        if (! is_file($path)) {
            // The generator has not run yet: render live instead of failing.
            return $next($request);
        }

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.DemoAssetPaths::normalize($name).'.pdf"',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    private function hasCustomFilters(Request $request): bool
    {
        $filters = array_diff_key($request->query(), array_flip(['locale', 'format_locale']));

        return $filters !== [];
    }

    private function locale(Request $request): string
    {
        $locale = $request->query('locale');
        $supported = DemoAssetPaths::locales();

        if (is_string($locale) && mb_trim($locale) !== '') {
            $language = explode('_', ReportLocale::normalize($locale))[0];

            if (in_array($language, $supported, true)) {
                return $language;
            }
        }

        $default = (string) config('app.locale', 'en');

        return in_array($default, $supported, true) ? $default : $supported[0];
    }

    private function throttleLiveRendering(Request $request): void
    {
        $key = 'demo-pdf:'.$request->ip();

        if (! RateLimiter::attempt($key, self::LIVE_RENDERS_PER_MINUTE, fn (): bool => true, 60)) {
            abort(429, 'Too many PDF requests. Please try again in a minute.');
        }
    }
}
