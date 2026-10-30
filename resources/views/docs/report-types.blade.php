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
    </article>
@endsection
