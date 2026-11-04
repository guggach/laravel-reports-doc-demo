@extends('layouts.docs')

@section('title', __('site.excel.title').' · Laravel Reports')
@section('description', __('site.excel.lead'))

@php
    $usageTabs = [[
        'label' => 'Reports facade',
        'lang' => 'php',
        'code' => <<<'PHP'
use Guggach\Reports\Facades\Reports;

// Download the workbook.
return Reports::excel('excel_export')
    ->name('orders.xlsx')
    ->download();

// Same filters as the preview and the PDF.
Reports::excel('excel_export', ['category' => 'Miete'])
    ->name('miete.xlsx')
    ->save(storage_path('app/exports/miete.xlsx'));

// Stream inline, or write to a Laravel disk.
Reports::excel('excel_export')->stream();
Reports::excel('excel_export')->disk('local')->save('exports/orders.xlsx');
PHP,
    ], [
        'label' => 'Route',
        'lang' => 'bash',
        'code' => <<<'BASH'
# Registered by the package, with the same middleware and filters as /pdf.
GET /reports/excel_export/xlsx
GET /reports/excel_export/xlsx?locale=de
BASH,
    ], [
        'label' => 'Field metadata',
        'lang' => 'php',
        'code' => <<<'PHP'
new ReportField('amount', 'Betrag', type: 'number', format: 'currency:CHF', aggregatable: true),
new ReportField('ordered_at', 'Datum', type: 'date', format: 'date'),
new ReportField('status', 'Status', type: 'enum', options: [
    'offen' => 'Offen',
    'bezahlt' => 'Bezahlt',
]),
PHP,
    ]];

    $configTabs = [[
        'label' => 'config/reports.php',
        'lang' => 'php',
        'code' => <<<'PHP'
'exports' => [
    'word' => null,
    'excel' => [
        'freeze_header' => true,
        'auto_filter' => true,
        'totals' => 'aggregatable',
    ],
],
PHP,
    ]];
@endphp

@section('sidebar')
    <x-docs.sidebar />
@endsection

@section('content')
    <article class="max-w-4xl">
        <h1 class="doc-title">{{ __('site.excel.title') }}</h1>
        <p class="doc-lead">{{ __('site.excel.lead') }}</p>

        <h2 class="doc-h2">{{ __('site.excel.install_title') }}</h2>
        <p class="doc-p">{{ __('site.excel.install_lead') }}</p>
        <div class="mt-4">
            <x-ui.code :tabs="[[
                'label' => 'terminal',
                'lang' => 'bash',
                'code' => 'composer require phpoffice/phpspreadsheet',
            ]]" />
        </div>

        <h2 class="doc-h2">{{ __('site.excel.usage_title') }}</h2>
        <p class="doc-p">{{ __('site.excel.usage_lead') }}</p>
        <div class="mt-4">
            <x-ui.code :tabs="$usageTabs" />
        </div>

        <h2 class="doc-h2">{{ __('site.excel.fields_title') }}</h2>
        <p class="doc-p">{{ __('site.excel.fields_lead') }}</p>
        <x-docs.api-table :rows="trans('site.excel.fields')" />

        <h2 class="doc-h2">{{ __('site.excel.options_title') }}</h2>
        <p class="doc-p">{{ __('site.excel.options_lead') }}</p>
        <x-docs.api-table :rows="trans('site.excel.options')" />

        <div class="mt-4">
            <x-ui.code :tabs="$configTabs" :caption="__('site.excel.options_title')" />
        </div>

        <h2 class="doc-h2">{{ __('site.excel.limits_title') }}</h2>
        <p class="doc-p">{{ __('site.excel.limits') }}</p>

        <div class="mt-8 rounded-2xl border border-teal-200 bg-teal-50/60 p-6 dark:border-teal-500/20 dark:bg-teal-500/5">
            <p class="font-semibold text-teal-900 dark:text-teal-100">{{ __('site.excel.example_title') }}</p>
            <p class="mt-1 text-sm leading-relaxed text-teal-800/80 dark:text-teal-100/70">{{ __('site.excel.example_lead') }}</p>
            <div class="mt-3 flex flex-wrap gap-4 text-sm font-semibold">
                <a href="{{ route('examples.show', ['key' => 'excel_export']) }}" class="text-teal-700 hover:underline dark:text-teal-300">
                    {{ __('site.excel.example_link') }}
                </a>
                <a href="{{ route('reports.excel', ['name' => 'excel_export']) }}" class="text-teal-700 hover:underline dark:text-teal-300">
                    {{ __('site.excel.example_download') }}
                </a>
            </div>
        </div>

        <a
            href="{{ route('docs.show', ['page' => 'multilanguage']) }}"
            class="mt-12 flex items-center justify-between gap-4 rounded-2xl border border-slate-200 bg-white p-6 transition hover:border-teal-300 hover:shadow-sm dark:border-white/10 dark:bg-white/5 dark:hover:border-teal-500/40"
        >
            <span>
                <span class="block font-semibold text-slate-900 dark:text-white">{{ __('site.excel.next') }} · {{ __('site.docs.pages.multilanguage') }}</span>
                <span class="mt-1 block text-sm text-slate-600 dark:text-slate-300">{{ __('site.excel.next_text') }}</span>
            </span>
            <svg class="h-5 w-5 shrink-0 text-teal-600 dark:text-teal-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12h14m-6-6 6 6-6 6" /></svg>
        </a>
    </article>
@endsection
