<?php

use App\Reports\PriceList\Report as PriceListReport;
use Guggach\Reports\Facades\Reports;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/report/price-list', fn (): string => Reports::html(
    new PriceListReport,
    options: ['meta' => ['subtitle' => 'Preisliste 2026']],
));

Route::get('/report/price-list/preview', fn () => view('preview', [
    'pageSetup' => Reports::pageSetup(new PriceListReport),
]));
