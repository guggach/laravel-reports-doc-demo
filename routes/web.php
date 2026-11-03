<?php

use App\Http\Controllers\DocsController;
use App\Http\Controllers\SeoController;
use App\Http\Middleware\NoIndex;
use Guggach\Reports\Facades\Reports;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Documentation site (localized)
|--------------------------------------------------------------------------
| English is the default and lives without a URL prefix; German is served
| under /de. The localizer detects the visitor's browser language, redirects
| once and remembers the choice (session + cookie).
*/
Route::localize(function (): void {
    Route::get('/', [DocsController::class, 'home'])->name('home');
    Route::get('/docs', [DocsController::class, 'index'])->name('docs.index');
    Route::get('/docs/{page}', [DocsController::class, 'show'])->name('docs.show');
});

/*
|--------------------------------------------------------------------------
| Example reports (localized, but not indexable)
|--------------------------------------------------------------------------
| These pages are an interactive playground. They stay usable for humans and
| are excluded from search engines with an X-Robots-Tag header: the filter
| combinations produce thin, endless URL variants.
*/
Route::localize(function (): void {
    Route::get('/examples', [DocsController::class, 'examples'])
        ->middleware(NoIndex::class)
        ->name('examples.index');
    Route::get('/examples/{key}', [DocsController::class, 'example'])
        ->middleware(NoIndex::class)
        ->name('examples.show');
});

/*
|--------------------------------------------------------------------------
| Crawl metadata
|--------------------------------------------------------------------------
| Generated instead of shipped as static files so the sitemap URL always
| matches the host the site is actually served from.
*/
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');
Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');

/*
|--------------------------------------------------------------------------
| Demo reports (not localized)
|--------------------------------------------------------------------------
| The package registers /reports/{name}, /reports/{name}/run,
| /reports/internal/{name} and /reports/{name}/pdf. They stay unprefixed on
| purpose: they are examples, not localized content pages.
*/
Route::get('/download/price-list', fn () => Reports::pdf('price_list')
    ->name('preisliste.pdf')
    ->download());
