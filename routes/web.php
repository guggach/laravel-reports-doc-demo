<?php

use App\Http\Controllers\DocsController;
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
    Route::get('/examples', [DocsController::class, 'examples'])->name('examples.index');
    Route::get('/examples/{key}', [DocsController::class, 'example'])->name('examples.show');
    Route::get('/docs', [DocsController::class, 'index'])->name('docs.index');
    Route::get('/docs/{page}', [DocsController::class, 'show'])->name('docs.show');
});

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
