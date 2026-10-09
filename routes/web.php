<?php

use Guggach\Reports\Facades\Reports;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
 * Reports are addressed by their key(). The package registers:
 *   /reports/{name}           preview page (frame + iframe)
 *   /reports/internal/{name}  the report document
 *   /reports/{name}/pdf       streamed PDF
 *
 * This extra route just demonstrates the fluent PDF verbs (download + name).
 */
Route::get('/download/price-list', fn () => Reports::pdf('price_list')
    ->name('preisliste.pdf')
    ->download());
