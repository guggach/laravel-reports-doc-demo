@extends('layouts.docs')

@section('title', __('site.examples.page_title').' · Laravel Reports')
@section('description', __('site.examples.page_lead'))

@section('content')
    <div class="mx-auto max-w-5xl px-4 py-14 sm:px-6 lg:px-8">
        <h1 class="doc-title">{{ __('site.examples.page_title') }}</h1>
        <p class="doc-lead">{{ __('site.examples.page_lead') }}</p>

        <div class="mt-12 divide-y divide-slate-200 dark:divide-white/10">
            @foreach ($examples as $example)
                @php
                    $key = $example['key'];
                    $preview = route('reports.preview', ['name' => $key]);
                    $pdf = route('reports.pdf', ['name' => $key]);
                    $excel = ($example['excel'] ?? false) ? route('reports.excel', ['name' => $key]) : null;
                @endphp

                <article class="py-8 first:pt-0">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div>
                            <h2 class="text-xl font-semibold tracking-tight text-slate-900 dark:text-white">
                                {{ __("site.examples.items.{$key}.title") }}
                                <span class="font-normal text-slate-400">· {{ __("site.examples.items.{$key}.tagline") }}</span>
                            </h2>

                            <div class="mt-2 flex flex-wrap items-center gap-2">
                                @foreach ($example['badges'] as $badge)
                                    <span class="rounded-full border border-slate-200 bg-slate-50 px-2.5 py-0.5 text-xs font-medium text-slate-600 dark:border-white/10 dark:bg-white/5 dark:text-slate-300">
                                        {{ __("site.examples.badges.{$badge}") }}
                                    </span>
                                @endforeach
                                <code class="rounded-md bg-slate-100 px-2 py-0.5 font-mono text-xs text-slate-500 dark:bg-white/5 dark:text-slate-400">{{ parse_url($preview, PHP_URL_PATH) }}</code>
                            </div>
                        </div>

                        <div class="flex shrink-0 gap-2">
                            <a
                                href="{{ $preview }}"
                                target="_blank"
                                rel="noopener"
                                class="inline-flex items-center gap-1.5 rounded-lg bg-slate-900 px-3.5 py-2 text-sm font-semibold text-white transition hover:bg-slate-700 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-200"
                            >
                                {{ __('site.examples.url') }}
                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 17 17 7M9 7h8v8" /></svg>
                            </a>
                            @if ($excel)
                                <a
                                    href="{{ $excel }}"
                                    class="inline-flex items-center gap-1.5 rounded-lg border border-slate-300 bg-white px-3.5 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-white/15 dark:bg-white/5 dark:text-slate-200 dark:hover:bg-white/10"
                                >{{ __('site.actions.excel') }}</a>
                            @endif
                            <a
                                href="{{ route('examples.show', ['key' => $key]) }}"
                                class="inline-flex items-center gap-1.5 rounded-lg border border-slate-300 bg-white px-3.5 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-white/15 dark:bg-white/5 dark:text-slate-200 dark:hover:bg-white/10"
                            >{{ __('site.examples.code') }}</a>
                        </div>
                    </div>

                    <p class="mt-3 max-w-3xl text-slate-600 dark:text-slate-300">{{ __("site.examples.items.{$key}.description") }}</p>

                    <ul class="mt-4 grid gap-2 sm:grid-cols-2">
                        @foreach (__("site.examples.items.{$key}.highlights") as $highlight)
                            <li class="flex items-start gap-2 text-sm text-slate-600 dark:text-slate-300">
                                <svg class="mt-0.5 h-4 w-4 shrink-0 text-teal-600 dark:text-teal-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m5 13 4 4L19 7" /></svg>
                                {{ $highlight }}
                            </li>
                        @endforeach
                    </ul>
                </article>
            @endforeach
        </div>
    </div>
@endsection
