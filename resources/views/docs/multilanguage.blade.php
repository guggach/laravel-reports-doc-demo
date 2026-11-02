@extends('layouts.docs')

@section('title', __('site.multilanguage.title').' · Laravel Reports')
@section('description', __('site.multilanguage.lead'))

@php
    $langTabs = [[
        'label' => 'lang/de/report.php',
        'lang' => 'php',
        'code' => <<<'PHP'
<?php

return [
    'name' => 'Mehrsprachige Preisliste',
    'title' => 'Preisliste',
    'columns' => [
        'product' => 'Produkt',
        'price' => 'Preis',
    ],
];
PHP,
    ], [
        'label' => 'views/report-start.blade.php',
        'lang' => 'blade',
        'code' => <<<'BLADE'
<h1>{{ __('multilanguage::report.title') }}</h1>

<span>{{ __('multilanguage::report.language_label') }}: {{ $ctx->locale }}</span>
<span>{{ __('multilanguage::report.format_label') }}: {{ $ctx->formatLocale }}</span>
BLADE,
    ]];

    $runtimeTabs = [[
        'label' => 'per run',
        'lang' => 'php',
        'code' => <<<'PHP'
use Guggach\Reports\Reports;

$html = Reports::html('multilanguage', locale: 'en');
$pdf = Reports::pdf('multilanguage', locale: 'en')->stream();
PHP,
    ], [
        'label' => 'frame selector',
        'lang' => 'blade',
        'code' => <<<'BLADE'
<x-reports::frame
    :url="$frameUrl"
    :pdf="$pdfUrl"
    :locales="$locales"
    :locale="$locale"
/>
BLADE,
    ]];

    $sourceTabs = [[
        'label' => 'Eloquent + Translatable',
        'lang' => 'php',
        'code' => <<<'PHP'
use App\Models\Product;

public function records(): iterable
{
    // app()->getLocale() is already set to the run language.
    // spatie/laravel-translatable reads the ambient locale lazily.
    return Product::query()->get();
}
PHP,
    ], [
        'label' => 'language column',
        'lang' => 'php',
        'code' => <<<'PHP'
public function records(): iterable
{
    return DB::table('products')
        ->where('language', $this->locale())
        ->get();
}
PHP,
    ], [
        'label' => 'language arrays',
        'lang' => 'php',
        'code' => <<<'PHP'
use Guggach\Reports\Localization\ReportLocale;

public function records(): iterable
{
    $language = explode('_', ReportLocale::normalize(
        $this->locale() ?? app()->getLocale(),
    ))[0];

    $records = [
        ['product' => ['de' => 'Studio Miete', 'en' => 'Studio rent']],
    ];

    return array_map(function (array $record) use ($language): array {
        $record['product'] = $record['product'][$language]
            ?? $record['product']['en'];

        return $record;
    }, $records);
}
PHP,
    ]];

    $recordTabs = [[
        'label' => 'Report.php',
        'lang' => 'php',
        'code' => <<<'PHP'
$r->freeform(view: 'invoice')
    ->localeField('language')
    ->formatLocaleField('format_locale');
PHP,
    ], [
        'label' => 'Source.php',
        'lang' => 'php',
        'code' => <<<'PHP'
return [
    ['invoice_id' => 1, 'language' => 'de', 'format_locale' => 'de_CH'],
    ['invoice_id' => 2, 'language' => 'en', 'format_locale' => 'en_US'],
];
PHP,
    ]];
@endphp

@section('sidebar')
    <x-docs.sidebar />
@endsection

@section('content')
    <article class="max-w-4xl">
        <h1 class="doc-title">{{ __('site.multilanguage.title') }}</h1>
        <p class="doc-lead">{{ __('site.multilanguage.lead') }}</p>

        <h2 class="doc-h2">{{ __('site.multilanguage.axes_title') }}</h2>
        <p class="doc-p">{{ __('site.multilanguage.axes_lead') }}</p>

        <x-docs.api-table :rows="trans('site.multilanguage.axes')" />

        <h2 class="doc-h2">{{ __('site.multilanguage.lang_title') }}</h2>
        <p class="doc-p">{{ __('site.multilanguage.lang_lead') }}</p>

        <div class="mt-6">
            <x-ui.code :tabs="$langTabs" :caption="__('site.multilanguage.lang_caption')" />
        </div>

        <div class="mt-4 rounded-xl border border-amber-200 bg-amber-50/60 p-4 dark:border-amber-500/20 dark:bg-amber-500/5">
            <p class="text-sm leading-relaxed text-amber-900/80 dark:text-amber-100/70">{{ __('site.multilanguage.lang_note') }}</p>
        </div>

        <h2 class="doc-h2">{{ __('site.multilanguage.runtime_title') }}</h2>
        <p class="doc-p">{{ __('site.multilanguage.runtime_lead') }}</p>

        <x-docs.api-table :rows="trans('site.multilanguage.runtime')" />

        <div class="mt-6">
            <x-ui.code :tabs="$runtimeTabs" :caption="__('site.multilanguage.runtime_caption')" />
        </div>

        <h2 class="doc-h2">{{ __('site.multilanguage.format_title') }}</h2>
        <p class="doc-p">{{ __('site.multilanguage.format_lead') }}</p>

        <x-docs.api-table :rows="trans('site.multilanguage.format')" />

        <div class="mt-4 rounded-xl border border-rose-200 bg-rose-50/60 p-4 dark:border-rose-500/20 dark:bg-rose-500/5">
            <p class="font-semibold text-rose-900 dark:text-rose-100">{{ __('site.multilanguage.format_note_title') }}</p>
            <p class="mt-1 text-sm leading-relaxed text-rose-800/80 dark:text-rose-100/70">{{ __('site.multilanguage.format_note') }}</p>
        </div>

        <h2 class="doc-h2">{{ __('site.multilanguage.source_title') }}</h2>
        <p class="doc-p">{{ __('site.multilanguage.source_lead') }}</p>

        <div class="mt-6">
            <x-ui.code :tabs="$sourceTabs" :caption="__('site.multilanguage.source_caption')" />
        </div>

        <div class="mt-4 rounded-xl border border-teal-200 bg-teal-50/60 p-4 dark:border-teal-500/20 dark:bg-teal-500/5">
            <p class="text-sm leading-relaxed text-teal-900/80 dark:text-teal-100/70">{{ __('site.multilanguage.source_note') }}</p>
        </div>

        <h2 class="doc-h2">{{ __('site.multilanguage.record_title') }}</h2>
        <p class="doc-p">{{ __('site.multilanguage.record_lead') }}</p>

        <x-docs.api-table :rows="trans('site.multilanguage.record')" />

        <div class="mt-6">
            <x-ui.code :tabs="$recordTabs" :caption="__('site.multilanguage.record_caption')" />
        </div>

        <div class="mt-12 grid gap-4 sm:grid-cols-2">
            <a
                href="{{ route('examples.show', ['key' => 'multilanguage']) }}"
                class="group rounded-2xl border border-slate-200 bg-white p-6 transition hover:border-teal-300 hover:shadow-sm dark:border-white/10 dark:bg-white/5 dark:hover:border-teal-500/40"
            >
                <span class="block font-semibold text-slate-900 dark:text-white">{{ __('site.multilanguage.example_link') }}</span>
                <span class="mt-1 block text-sm text-slate-600 dark:text-slate-300">{{ __('site.multilanguage.example_link_text') }}</span>
            </a>

            <a
                href="{{ route('examples.show', ['key' => 'group_enrichment']) }}"
                class="group rounded-2xl border border-slate-200 bg-white p-6 transition hover:border-teal-300 hover:shadow-sm dark:border-white/10 dark:bg-white/5 dark:hover:border-teal-500/40"
            >
                <span class="block font-semibold text-slate-900 dark:text-white">{{ __('site.multilanguage.enrichment_link') }}</span>
                <span class="mt-1 block text-sm text-slate-600 dark:text-slate-300">{{ __('site.multilanguage.enrichment_link_text') }}</span>
            </a>

            <a
                href="{{ route('docs.show', ['page' => 'groups']) }}"
                class="group rounded-2xl border border-slate-200 bg-white p-6 transition hover:border-teal-300 hover:shadow-sm dark:border-white/10 dark:bg-white/5 dark:hover:border-teal-500/40"
            >
                <span class="block font-semibold text-slate-900 dark:text-white">{{ __('site.multilanguage.next') }} · {{ __('site.docs.pages.groups') }}</span>
                <span class="mt-1 block text-sm text-slate-600 dark:text-slate-300">{{ __('site.multilanguage.next_text') }}</span>
            </a>
        </div>
    </article>
@endsection
