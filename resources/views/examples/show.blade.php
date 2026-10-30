@extends('layouts.docs')

@section('title', __('site.examples.items.'.$example['key'].'.title').' · Laravel Reports')
@section('description', __('site.examples.items.'.$example['key'].'.description'))

@section('content')
    @php
        $key = $example['key'];
        $preview = route('reports.preview', ['name' => $key]);
        $pdf = route('reports.pdf', ['name' => $key]);
    @endphp

    <div class="mx-auto max-w-5xl px-4 py-14 sm:px-6 lg:px-8">
        <a href="{{ route('examples.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-500 transition hover:text-slate-900 dark:text-slate-400 dark:hover:text-white">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M19 12H5m6 6-6-6 6-6" /></svg>
            {{ __('site.examples.back') }}
        </a>

        <h1 class="doc-title mt-6">
            {{ __("site.examples.items.{$key}.title") }}
            <span class="font-normal text-slate-400">· {{ __("site.examples.items.{$key}.tagline") }}</span>
        </h1>
        <p class="doc-lead">{{ __("site.examples.items.{$key}.description") }}</p>

        <div class="mt-4 flex flex-wrap items-center gap-2">
            @foreach ($example['badges'] as $badge)
                <span class="rounded-full border border-slate-200 bg-slate-50 px-2.5 py-0.5 text-xs font-medium text-slate-600 dark:border-white/10 dark:bg-white/5 dark:text-slate-300">
                    {{ __("site.examples.badges.{$badge}") }}
                </span>
            @endforeach
            <code class="rounded-md bg-slate-100 px-2 py-0.5 font-mono text-xs text-slate-500 dark:bg-white/5 dark:text-slate-400">{{ parse_url($preview, PHP_URL_PATH) }}</code>
        </div>

        <div class="mt-8 flex flex-wrap gap-3">
            <a
                href="{{ $preview }}"
                target="_blank"
                rel="noopener"
                class="inline-flex items-center gap-2 rounded-lg bg-teal-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-teal-700"
            >
                {{ __('site.actions.open_full') }}
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 17 17 7M9 7h8v8" /></svg>
            </a>
            <a
                href="{{ $pdf }}"
                class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-white/15 dark:bg-white/5 dark:text-slate-200 dark:hover:bg-white/10"
            >{{ __('site.actions.pdf') }}</a>
            <a
                href="#code"
                class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-white/15 dark:bg-white/5 dark:text-slate-200 dark:hover:bg-white/10"
            >{{ __('site.examples.code') }}</a>
        </div>

        <div class="mt-10">
            <x-ui.preview
                :src="$preview"
                :pdf="$pdf"
                :title="__('site.examples.items.'.$key.'.title')"
                height="40rem"
            />
        </div>

        <div class="mt-12 grid gap-10 lg:grid-cols-2">
            <div>
                <h2 class="text-lg font-semibold text-slate-900 dark:text-white">{{ __('site.examples.highlights') }}</h2>
                <ul class="mt-4 space-y-2">
                    @foreach (__("site.examples.items.{$key}.highlights") as $highlight)
                        <li class="flex items-start gap-2 text-sm text-slate-600 dark:text-slate-300">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-teal-600 dark:text-teal-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m5 13 4 4L19 7" /></svg>
                            {{ $highlight }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-slate-900 dark:text-white">{{ __('site.examples.structure') }}</h2>
                <div class="mt-4">
                    <x-ui.code :tabs="[[
                        'label' => 'Struktur',
                        'lang' => 'text',
                        'code' => $example['structure'],
                    ]]" />
                </div>
            </div>
        </div>

        <h2 id="code" class="doc-h2 scroll-mt-24">{{ __('site.examples.files') }}</h2>
        <div class="mt-4">
            <x-ui.code :tabs="$example['files']" />
        </div>
    </div>
@endsection
