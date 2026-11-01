@extends('layouts.docs')

@section('title', __('site.getting-started.title').' · Laravel Reports')

@section('sidebar')
    <x-docs.sidebar />
@endsection

@section('content')
    @php($priceList = collect(config('docs.examples'))->firstWhere('key', 'price_list'))

    <article class="max-w-3xl">
        <h1 class="doc-title">{{ __('site.getting-started.title') }}</h1>
        <p class="doc-lead">{{ __('site.getting-started.lead') }}</p>

        <h2 class="doc-h2">{{ __('site.getting-started.step_1') }}</h2>
        <p class="doc-p">{{ __('site.getting-started.step_1_text') }}</p>
        <div class="mt-4">
            <x-ui.code :tabs="[[
                'label' => 'terminal',
                'lang' => 'bash',
                'code' => 'composer require guggach/laravel-reports',
            ]]" />
        </div>

        <h2 class="doc-h2">{{ __('site.getting-started.step_2') }}</h2>
        <p class="doc-p">{{ __('site.getting-started.step_2_text') }}</p>
        <div class="mt-4 space-y-6">
            <x-ui.code :tabs="[[
                'label' => 'Struktur',
                'lang' => 'text',
                'code' => $priceList['structure'],
            ]]" />
            <x-ui.code :tabs="array_slice($priceList['files'], 0, 3)" />
        </div>

        <h2 class="doc-h2">{{ __('site.getting-started.step_3') }}</h2>
        <p class="doc-p">{{ __('site.getting-started.step_3_text') }}</p>
        <div class="mt-4">
            <x-ui.code :tabs="[[
                'label' => 'routes',
                'lang' => 'bash',
                'code' => "GET /reports/price_list            # filter form\nGET /reports/price_list/run        # preview frame + document\nGET /reports/internal/price_list   # the report document\nGET /reports/price_list/pdf        # streamed PDF",
            ]]" />
        </div>

        <a
            href="{{ route('docs.show', ['page' => 'routing']) }}"
            class="mt-12 flex items-center justify-between gap-4 rounded-2xl border border-slate-200 bg-white p-6 transition hover:border-teal-300 hover:shadow-sm dark:border-white/10 dark:bg-white/5 dark:hover:border-teal-500/40"
        >
            <span>
                <span class="block font-semibold text-slate-900 dark:text-white">{{ __('site.getting-started.next') }} · {{ __('site.docs.pages.routing') }}</span>
                <span class="mt-1 block text-sm text-slate-600 dark:text-slate-300">{{ __('site.getting-started.next_text') }}</span>
            </span>
            <svg class="h-5 w-5 shrink-0 text-teal-600 dark:text-teal-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12h14m-6-6 6 6-6 6" /></svg>
        </a>
    </article>
@endsection
