@extends('layouts.docs')

@section('title', __('site.docs.title').' · Laravel Reports')

@section('sidebar')
    <x-docs.sidebar />
@endsection

@section('content')
    <h1 class="doc-title">{{ __('site.docs.title') }}</h1>
    <p class="doc-lead">{{ __('site.docs.lead') }}</p>

    <div class="mt-10 grid gap-4 sm:grid-cols-2">
        @foreach (config('docs.pages') as $slug => $page)
            <a
                href="{{ route('docs.show', ['page' => $slug]) }}"
                class="group rounded-2xl border border-slate-200 bg-white p-6 transition hover:border-teal-300 hover:shadow-sm dark:border-white/10 dark:bg-white/5 dark:hover:border-teal-500/40"
            >
                <h2 class="font-semibold text-slate-900 dark:text-white">{{ __($page['title']) }}</h2>
                <span class="mt-3 inline-flex items-center gap-1.5 text-sm font-medium text-teal-700 dark:text-teal-300">
                    {{ __('site.actions.open') }}
                    <svg class="h-4 w-4 transition group-hover:translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12h14m-6-6 6 6-6 6" /></svg>
                </span>
            </a>
        @endforeach
    </div>
@endsection
