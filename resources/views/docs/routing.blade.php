@extends('layouts.docs')

@section('title', __('site.routing.title').' · Laravel Reports')
@section('description', __('site.routing.lead'))

@php
    $linkTabs = [[
        'label' => 'Blade links',
        'lang' => 'blade',
        'code' => <<<'BLADE'
{{-- 1. Filter form first: the user chooses filters, then continues. --}}
<a href="{{ route('reports.form', ['name' => 'price_list']) }}">Preisliste öffnen</a>

{{-- 2. Direct preview, with filters in the query string. --}}
@php($filters = [
    'category' => 'Küche',
    'price' => ['operator' => '>=', 'value' => [50]],
])
<a href="{{ route('reports.preview', ['name' => 'price_list']).'?'.http_build_query($filters) }}">Vorschau</a>

{{-- 3. The raw report document, e.g. for your own iframe. --}}
<iframe src="{{ route('reports.internal', ['name' => 'price_list']).'?'.http_build_query($filters) }}"></iframe>

{{-- 4. Streamed PDF with the same filters. --}}
<a href="{{ route('reports.pdf', ['name' => 'price_list']).'?'.http_build_query($filters) }}">PDF</a>
BLADE,
    ]];

    $codeTabs = [[
        'label' => 'Reports facade',
        'lang' => 'php',
        'code' => <<<'PHP'
use Guggach\Reports\Facades\Reports;

// Full HTML document (layout + bands) as a string.
$html = Reports::html('price_list', ['category' => 'Küche']);

// Same pipeline; the configured renderer decides the return type.
$result = Reports::render('price_list', ['category' => 'Küche']);

// PDF: stream, download or save.
return Reports::pdf('price_list', ['category' => 'Küche'])
    ->name('preisliste.pdf')
    ->download();

// Filter metadata for a custom UI.
$controls = Reports::filterControls('price_list'); // FilterControl[]
$schema = Reports::filterSchema('price_list');     // array, JSON-ready
PHP,
    ], [
        'label' => 'Controller',
        'lang' => 'php',
        'code' => <<<'PHP'
use Guggach\Reports\Facades\Reports;
use Illuminate\Http\Response;

final class PriceListController
{
    public function __invoke(): Response
    {
        return response(
            Reports::html('price_list', ['category' => 'Küche'])
        );
    }
}
PHP,
    ]];

    $configTabs = [[
        'label' => 'config/reports.php',
        'lang' => 'php',
        'code' => <<<'PHP'
'routes' => [
    'enabled' => true,
    'prefix' => 'reports',

    // Add your own middleware, e.g. auth or a report policy.
    'middleware' => ['web', 'auth'],
],
PHP,
    ]];
@endphp

@section('sidebar')
    <x-docs.sidebar />
@endsection

@section('content')
    <article class="max-w-4xl">
        <h1 class="doc-title">{{ __('site.routing.title') }}</h1>
        <p class="doc-lead">{{ __('site.routing.lead') }}</p>

        <h2 class="doc-h2">{{ __('site.routing.routes_title') }}</h2>
        <p class="doc-p">{{ __('site.routing.routes_lead') }}</p>

        <x-docs.api-table :rows="trans('site.routing.routes')" />

        <div class="mt-4 rounded-xl border border-amber-200 bg-amber-50/60 p-4 dark:border-amber-500/20 dark:bg-amber-500/5">
            <p class="font-semibold text-amber-900 dark:text-amber-100">{{ __('site.routing.redirect_title') }}</p>
            <p class="mt-1 text-sm leading-relaxed text-amber-800/80 dark:text-amber-100/70">{{ __('site.routing.redirect_text') }}</p>
        </div>

        <h2 class="doc-h2">{{ __('site.routing.flow_title') }}</h2>
        <p class="doc-p">{{ __('site.routing.flow_lead') }}</p>

        <div class="mt-6 grid gap-4 sm:grid-cols-3">
            @foreach (trans('site.routing.flow') as $step)
                <div class="rounded-2xl border border-slate-200 bg-white p-5 dark:border-white/10 dark:bg-white/5">
                    <p class="font-mono text-xs font-semibold text-teal-700 dark:text-teal-300">{{ $step['route'] }}</p>
                    <p class="mt-2 font-semibold text-slate-900 dark:text-white">{{ $step['title'] }}</p>
                    <p class="mt-1 text-sm leading-relaxed text-slate-600 dark:text-slate-300">{{ $step['text'] }}</p>
                </div>
            @endforeach
        </div>

        <h2 class="doc-h2">{{ __('site.routing.links_title') }}</h2>
        <p class="doc-p">{{ __('site.routing.links_lead') }}</p>

        <div class="mt-4">
            <x-ui.code :tabs="$linkTabs" :caption="__('site.routing.links_caption')" />
        </div>

        <div class="mt-4 rounded-xl border border-rose-200 bg-rose-50/60 p-4 dark:border-rose-500/20 dark:bg-rose-500/5">
            <p class="font-semibold text-rose-900 dark:text-rose-100">{{ __('site.routing.collision_title') }}</p>
            <p class="mt-1 text-sm leading-relaxed text-rose-800/80 dark:text-rose-100/70">{{ __('site.routing.collision_text') }}</p>
        </div>

        <h2 class="doc-h2">{{ __('site.routing.query_title') }}</h2>
        <p class="doc-p">{{ __('site.routing.query_lead') }}</p>

        <x-docs.api-table :rows="trans('site.routing.query')" />

        <h2 class="doc-h2">{{ __('site.routing.code_title') }}</h2>
        <p class="doc-p">{{ __('site.routing.code_lead') }}</p>

        <x-docs.api-table :rows="trans('site.routing.code_methods')" />

        <div class="mt-6">
            <x-ui.code :tabs="$codeTabs" :caption="__('site.routing.code_caption')" />
        </div>

        <h2 class="doc-h2">{{ __('site.routing.config_title') }}</h2>
        <p class="doc-p">{{ __('site.routing.config_lead') }}</p>

        <div class="mt-4">
            <x-ui.code :tabs="$configTabs" :caption="__('site.routing.config_caption')" />
        </div>

        <div class="mt-4 rounded-xl border border-slate-200 bg-slate-50/70 p-4 dark:border-white/10 dark:bg-white/5">
            <p class="text-sm leading-relaxed text-slate-700 dark:text-slate-300">{{ __('site.routing.config_note') }}</p>
        </div>

        <a
            href="{{ route('docs.show', ['page' => 'report-types']) }}"
            class="mt-12 flex items-center justify-between gap-4 rounded-2xl border border-slate-200 bg-white p-6 transition hover:border-teal-300 hover:shadow-sm dark:border-white/10 dark:bg-white/5 dark:hover:border-teal-500/40"
        >
            <span>
                <span class="block font-semibold text-slate-900 dark:text-white">{{ __('site.routing.next') }} · {{ __('site.docs.pages.report-types') }}</span>
                <span class="mt-1 block text-sm text-slate-600 dark:text-slate-300">{{ __('site.routing.next_text') }}</span>
            </span>
            <svg class="h-5 w-5 shrink-0 text-teal-600 dark:text-teal-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12h14m-6-6 6 6-6 6" /></svg>
        </a>
    </article>
@endsection
