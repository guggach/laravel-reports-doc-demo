@extends('layouts.docs')

@section('title', __('site.report-types.title').' · Laravel Reports')

@section('sidebar')
    <x-docs.sidebar />
@endsection

@section('content')
    <article class="max-w-3xl">
        <h1 class="doc-title">{{ __('site.report-types.title') }}</h1>
        <p class="doc-lead">{{ __('site.report-types.lead') }}</p>

        <div class="mt-10 grid gap-6 sm:grid-cols-2">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 dark:border-white/10 dark:bg-white/5">
                <h2 class="font-semibold text-slate-900 dark:text-white">{{ __('site.report-types.flow_title') }}</h2>
                <p class="mt-2 text-sm leading-relaxed text-slate-600 dark:text-slate-300">{{ __('site.report-types.flow_text') }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-6 dark:border-white/10 dark:bg-white/5">
                <h2 class="font-semibold text-slate-900 dark:text-white">{{ __('site.report-types.strict_title') }}</h2>
                <p class="mt-2 text-sm leading-relaxed text-slate-600 dark:text-slate-300">{{ __('site.report-types.strict_text') }}</p>
            </div>
        </div>

        <h2 class="doc-h2">{{ __('site.report-types.list_title') }}</h2>
        <p class="doc-p">{{ __('site.report-types.list_text') }}</p>
        <div class="mt-4">
            <x-ui.code :tabs="['app/Reports/PriceList/Report.php']" />
        </div>

        <h2 class="doc-h2">{{ __('site.report-types.form_title') }}</h2>
        <p class="doc-p">{{ __('site.report-types.form_text') }}</p>

        <a
            href="{{ route('docs.show', ['page' => 'bands']) }}"
            class="mt-12 flex items-center justify-between gap-4 rounded-2xl border border-slate-200 bg-white p-6 transition hover:border-teal-300 hover:shadow-sm dark:border-white/10 dark:bg-white/5 dark:hover:border-teal-500/40"
        >
            <span>
                <span class="block font-semibold text-slate-900 dark:text-white">{{ __('site.report-types.next') }} · {{ __('site.docs.pages.bands') }}</span>
                <span class="mt-1 block text-sm text-slate-600 dark:text-slate-300">{{ __('site.report-types.next_text') }}</span>
            </span>
            <svg class="h-5 w-5 shrink-0 text-teal-600 dark:text-teal-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12h14m-6-6 6 6-6 6" /></svg>
        </a>
    </article>
@endsection
