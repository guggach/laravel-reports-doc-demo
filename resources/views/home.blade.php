@extends('layouts.docs')

@section('title', __('site.meta.title'))
@section('description', __('site.meta.description'))

@section('content')
    @php
        $heroSnippet = <<<'PHP'
        $r->reportStart(view: 'report-start');
        $r->gridHeader(view: 'grid-head');
        $r->detail(view: 'row');
        $r->reportEnd(view: 'report-end');

        $r->group('category', function ($g) {
            $g->footer(view: 'category-foot');
            $g->aggSum('price', as: 'total');
        });
        PHP;

        $priceList = collect($examples)->firstWhere('key', 'price_list');
    @endphp

    {{-- Hero --}}
    <section class="relative overflow-hidden border-b border-slate-200 dark:border-white/10">
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-teal-50 via-white to-white dark:from-teal-950/30 dark:via-slate-950 dark:to-slate-950"></div>

        <div class="mx-auto grid max-w-7xl items-center gap-14 px-4 py-16 sm:px-6 lg:grid-cols-2 lg:px-8 lg:py-24">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full border border-teal-200 bg-teal-50 px-3 py-1 text-xs font-semibold text-teal-700 dark:border-teal-500/20 dark:bg-teal-500/10 dark:text-teal-300">
                    <span class="h-1.5 w-1.5 rounded-full bg-teal-500"></span>
                    {{ __('site.hero.badge') }}
                </span>

                <h1 class="mt-5 text-4xl font-semibold tracking-tight text-slate-900 sm:text-5xl dark:text-white">
                    {{ __('site.hero.title') }}
                </h1>

                <p class="mt-5 max-w-xl text-lg leading-relaxed text-slate-600 dark:text-slate-300">
                    {{ __('site.hero.lead') }}
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a
                        href="{{ route('reports.preview', ['name' => 'price_list']) }}"
                        class="inline-flex items-center gap-2 rounded-lg bg-teal-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-teal-700"
                    >
                        {{ __('site.hero.primary') }}
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12h14m-6-6 6 6-6 6" /></svg>
                    </a>
                    <a
                        href="{{ route('docs.show', ['page' => 'getting-started']) }}"
                        class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-white/15 dark:bg-white/5 dark:text-slate-200 dark:hover:bg-white/10"
                    >
                        {{ __('site.hero.secondary') }}
                    </a>
                </div>

                <ul class="mt-8 flex flex-wrap gap-x-6 gap-y-2 text-sm text-slate-500 dark:text-slate-400">
                    @foreach (['proof_1', 'proof_2', 'proof_3'] as $proof)
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-teal-600 dark:text-teal-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m5 13 4 4L19 7" /></svg>
                            {{ __("site.hero.{$proof}") }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="relative">
                <div class="absolute -inset-6 -z-10 rounded-[2rem] bg-gradient-to-tr from-teal-200/40 to-transparent blur-2xl dark:from-teal-500/20"></div>

                <div class="relative mx-auto w-full max-w-xl">
                    <img
                        src="{{ asset('images/hero-price-list.png') }}"
                        alt="{{ __('site.examples.items.price_list.title') }}"
                        class="w-full rounded-xl shadow-2xl ring-1 ring-black/10 [transform:perspective(1500px)_rotateX(5deg)_rotateY(-9deg)_rotate(-1.5deg)] dark:ring-white/10"
                    >

                    <div class="absolute -bottom-8 -left-4 hidden w-72 rotate-2 sm:block">
                        <x-ui.code
                            :tabs="[['code' => $heroSnippet, 'lang' => 'php', 'label' => 'Report.php']]"
                            class="shadow-xl backdrop-blur"
                        />
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Features --}}
    <section id="features" class="scroll-mt-24 border-b border-slate-200 dark:border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
            <div class="max-w-2xl">
                <h2 class="text-3xl font-semibold tracking-tight text-slate-900 dark:text-white">{{ __('site.features.title') }}</h2>
                <p class="mt-4 text-lg text-slate-600 dark:text-slate-300">{{ __('site.features.lead') }}</p>
            </div>

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach (['bands', 'modes', 'modules', 'filters', 'layouts', 'output'] as $item)
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 transition hover:border-teal-300 hover:shadow-sm dark:border-white/10 dark:bg-white/5 dark:hover:border-teal-500/40">
                        <h3 class="font-semibold text-slate-900 dark:text-white">{{ __("site.features.items.{$item}.title") }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-600 dark:text-slate-300">{{ __("site.features.items.{$item}.text") }}</p>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 flex flex-col gap-4 rounded-2xl border border-teal-200 bg-teal-50/60 p-5 sm:flex-row sm:items-center sm:justify-between dark:border-teal-500/20 dark:bg-teal-500/5">
                <div>
                    <p class="font-semibold text-teal-900 dark:text-teal-100">{{ __('site.features.bands_link_title') }}</p>
                    <p class="mt-1 max-w-xl text-sm text-teal-800/80 dark:text-teal-100/70">{{ __('site.features.bands_link_text') }}</p>
                </div>
                <a
                    href="{{ route('docs.show', ['page' => 'bands']) }}"
                    class="inline-flex shrink-0 items-center gap-2 rounded-lg bg-teal-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-teal-700"
                >
                    {{ __('site.features.bands_link_cta') }}
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12h14m-6-6 6 6-6 6" /></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Examples --}}
    <section id="examples" class="scroll-mt-24 border-b border-slate-200 dark:border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div class="max-w-2xl">
                    <h2 class="text-3xl font-semibold tracking-tight text-slate-900 dark:text-white">{{ __('site.examples.title') }}</h2>
                    <p class="mt-4 text-lg text-slate-600 dark:text-slate-300">{{ __('site.examples.lead') }}</p>
                </div>
                <a href="{{ route('examples.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-teal-700 hover:text-teal-800 dark:text-teal-300">
                    {{ __('site.examples.back') }}
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12h14m-6-6 6 6-6 6" /></svg>
                </a>
            </div>

            <div class="mt-14 space-y-16">
                @foreach ($examples as $example)
                    @php($key = $example['key'])
                    <article class="scroll-mt-24" id="example-{{ $key }}">
                        <div class="grid gap-8 lg:grid-cols-2 lg:items-center">
                            <div>
                                <h3 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-white">
                                    {{ __("site.examples.items.{$key}.title") }}
                                    <span class="font-normal text-slate-400">· {{ __("site.examples.items.{$key}.tagline") }}</span>
                                </h3>
                                <p class="mt-3 max-w-lg text-slate-600 dark:text-slate-300">{{ __("site.examples.items.{$key}.description") }}</p>

                                <div class="mt-4 flex flex-wrap gap-2">
                                    @foreach ($example['badges'] as $badge)
                                        <span class="rounded-full border border-slate-200 bg-slate-50 px-2.5 py-0.5 text-xs font-medium text-slate-600 dark:border-white/10 dark:bg-white/5 dark:text-slate-300">
                                            {{ __("site.examples.badges.{$badge}") }}
                                        </span>
                                    @endforeach
                                </div>

                                <div class="mt-6 flex flex-wrap gap-3">
                                    <a
                                        href="{{ route('reports.preview', ['name' => $key]) }}"
                                        class="inline-flex items-center gap-2 rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-200"
                                    >{{ __('site.nav.demo') }}</a>
                                    <a
                                        href="{{ route('examples.show', ['key' => $key]) }}"
                                        class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-white/15 dark:bg-white/5 dark:text-slate-200 dark:hover:bg-white/10"
                                    >{{ __('site.examples.code') }}</a>
                                </div>
                            </div>

                            <div>
                                <x-ui.preview
                                    :src="route('reports.preview', ['name' => $key])"
                                    :pdf="route('reports.pdf', ['name' => $key])"
                                    :title="__('site.examples.items.'.$key.'.title')"
                                    height="30rem"
                                />
                            </div>
                        </div>

                        <div class="mt-6">
                            <x-ui.code :tabs="$example['files']" />
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Quickstart --}}
    <section id="quickstart" class="scroll-mt-24">
        <div class="mx-auto max-w-4xl px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
            <div class="max-w-2xl">
                <h2 class="text-3xl font-semibold tracking-tight text-slate-900 dark:text-white">{{ __('site.quickstart.title') }}</h2>
                <p class="mt-4 text-lg text-slate-600 dark:text-slate-300">{{ __('site.quickstart.lead') }}</p>
            </div>

            <div class="mt-12 space-y-14">
                {{-- Step 1 --}}
                <div>
                    <div class="flex items-center gap-3">
                        <span class="grid h-8 w-8 place-items-center rounded-full bg-teal-600 text-sm font-semibold text-white">1</span>
                        <h3 class="text-xl font-semibold text-slate-900 dark:text-white">{{ __('site.quickstart.step_1') }}</h3>
                    </div>
                    <p class="mt-3 pl-11 text-slate-600 dark:text-slate-300">{{ __('site.quickstart.step_1_text') }}</p>
                    <div class="mt-5 pl-11">
                        <x-ui.code :tabs="[[
                            'label' => 'terminal',
                            'lang' => 'bash',
                            'code' => 'composer require guggach/laravel-reports',
                        ]]" />
                    </div>
                </div>

                {{-- Step 2 --}}
                <div>
                    <div class="flex items-center gap-3">
                        <span class="grid h-8 w-8 place-items-center rounded-full bg-teal-600 text-sm font-semibold text-white">2</span>
                        <h3 class="text-xl font-semibold text-slate-900 dark:text-white">{{ __('site.quickstart.step_2') }}</h3>
                    </div>
                    <p class="mt-3 pl-11 text-slate-600 dark:text-slate-300">{{ __('site.quickstart.step_2_text') }}</p>

                    <div class="mt-5 space-y-6 pl-11">
                        <div>
                            <h4 class="mb-2 text-sm font-semibold text-slate-500 dark:text-slate-400">{{ __('site.examples.structure') }}</h4>
                            <x-ui.code :tabs="[[
                                'label' => 'Struktur',
                                'lang' => 'text',
                                'code' => $priceList['structure'],
                            ]]" />
                        </div>

                        <div>
                            <h4 class="mb-2 text-sm font-semibold text-slate-500 dark:text-slate-400">{{ __('site.examples.files') }}</h4>
                            <x-ui.code :tabs="array_slice($priceList['files'], 0, 3)" />
                        </div>
                    </div>
                </div>

                {{-- Step 3 --}}
                <div>
                    <div class="flex items-center gap-3">
                        <span class="grid h-8 w-8 place-items-center rounded-full bg-teal-600 text-sm font-semibold text-white">3</span>
                        <h3 class="text-xl font-semibold text-slate-900 dark:text-white">{{ __('site.quickstart.step_3') }}</h3>
                    </div>
                    <p class="mt-3 pl-11 text-slate-600 dark:text-slate-300">{{ __('site.quickstart.step_3_text') }}</p>
                    <div class="mt-5 pl-11">
                        <x-ui.code :tabs="[[
                            'label' => 'routes',
                            'lang' => 'bash',
                            'code' => "GET /reports/price_list            # filter form\nGET /reports/price_list/run        # preview frame + document\nGET /reports/internal/price_list   # the report document\nGET /reports/price_list/pdf        # streamed PDF",
                        ]]" />
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
