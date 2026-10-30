@extends('layouts.docs')

@section('title', __('site.bands.title').' · Laravel Reports')
@section('description', __('site.bands.lead'))

@section('sidebar')
    <x-docs.sidebar />
@endsection

@section('content')
    @php
        $toneDot = [
            'slate' => 'bg-slate-400',
            'blue' => 'bg-blue-500',
            'teal' => 'bg-teal-600',
            'indigo' => 'bg-indigo-500',
            'violet' => 'bg-violet-500',
            'emerald' => 'bg-emerald-500',
            'amber' => 'bg-amber-500',
            'rose' => 'bg-rose-500',
            'cyan' => 'bg-cyan-500',
        ];

        $legend = [
            ['key' => 'layout', 'mark' => 'L', 'tone' => 'slate'],
            ['key' => 'report_start', 'mark' => '1', 'tone' => 'teal'],
            ['key' => 'grid_header', 'mark' => '2', 'tone' => 'indigo'],
            ['key' => 'group_header', 'mark' => '3', 'tone' => 'violet'],
            ['key' => 'detail', 'mark' => '4', 'tone' => 'emerald'],
            ['key' => 'group_footer', 'mark' => '5', 'tone' => 'amber'],
            ['key' => 'report_end', 'mark' => '6', 'tone' => 'rose'],
        ];

        $stack = [
            ['band' => 'pageHeader()', 'scope' => 'page', 'depth' => 0, 'tone' => 'blue'],
            ['band' => 'reportStart()', 'scope' => 'report', 'depth' => 1, 'tone' => 'teal'],
            ['band' => 'gridHeader()', 'scope' => 'page', 'depth' => 1, 'tone' => 'indigo'],
            ['band' => 'group()->header()', 'scope' => 'group', 'depth' => 2, 'tone' => 'violet'],
            ['band' => 'detail()', 'scope' => 'record', 'depth' => 3, 'tone' => 'emerald'],
            ['band' => 'group()->footer()', 'scope' => 'group', 'depth' => 2, 'tone' => 'amber'],
            ['band' => 'reportEnd()', 'scope' => 'report', 'depth' => 1, 'tone' => 'rose'],
            ['band' => 'pageFooter()', 'scope' => 'page', 'depth' => 0, 'tone' => 'cyan'],
        ];

        $pagesLegend = [
            'page_header' => 'blue',
            'grid_header' => 'indigo',
            'detail' => 'emerald',
            'page_footer' => 'cyan',
        ];
    @endphp

    <article class="max-w-4xl">
        <h1 class="doc-title">{{ __('site.bands.title') }}</h1>
        <p class="doc-lead">{{ __('site.bands.lead') }}</p>

        <h2 class="doc-h2">{{ __('site.bands.example_title') }}</h2>
        <p class="doc-p">{{ __('site.bands.example_text') }}</p>

        <figure class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-white/10 dark:bg-white/5">
            <a href="{{ asset('images/docs/bands-price-list.png') }}" target="_blank" rel="noopener" class="block">
                <img
                    src="{{ asset('images/docs/bands-price-list.png') }}"
                    alt="{{ __('site.bands.overview_alt') }}"
                    class="block w-full"
                >
            </a>
            <figcaption class="border-t border-slate-200 px-4 py-3 text-xs text-slate-500 dark:border-white/10 dark:text-slate-400">
                {{ __('site.bands.overview_caption') }}
            </figcaption>
        </figure>

        <h3 class="doc-h3">{{ __('site.bands.legend_title') }}</h3>
        <ul class="mt-4 space-y-4">
            @foreach ($legend as $item)
                <li class="flex gap-3">
                    <span class="mt-0.5 grid h-6 w-6 shrink-0 place-items-center rounded-full text-[11px] font-semibold text-white {{ $toneDot[$item['tone']] }}">
                        {{ $item['mark'] }}
                    </span>
                    <div>
                        <p class="font-semibold text-slate-900 dark:text-white">{{ __("site.bands.legend.{$item['key']}.name") }}</p>
                        <p class="mt-1 text-sm leading-relaxed text-slate-600 dark:text-slate-300">{{ __("site.bands.legend.{$item['key']}.text") }}</p>
                    </div>
                </li>
            @endforeach
        </ul>

        <h2 class="doc-h2">{{ __('site.bands.stack_title') }}</h2>
        <p class="doc-p">{{ __('site.bands.stack_lead') }}</p>

        <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white dark:border-white/10 dark:bg-white/5">
            @foreach ($stack as $row)
                <div class="flex items-center justify-between gap-4 border-b border-slate-100 px-4 py-3 last:border-0 dark:border-white/5">
                    <div class="flex min-w-0 items-center gap-3" style="padding-left: {{ $row['depth'] * 1.25 }}rem">
                        <span class="h-2.5 w-2.5 shrink-0 rounded-full {{ $toneDot[$row['tone']] }}"></span>
                        <code class="truncate font-mono text-sm text-slate-700 dark:text-slate-200">{{ $row['band'] }}</code>
                    </div>
                    <span class="shrink-0 rounded-full border border-slate-200 bg-slate-50 px-2.5 py-0.5 text-xs font-medium text-slate-600 dark:border-white/10 dark:bg-white/5 dark:text-slate-300">
                        {{ __("site.bands.scopes.{$row['scope']}") }}
                    </span>
                </div>
            @endforeach
        </div>

        <div class="mt-6 rounded-xl border border-rose-200 bg-rose-50/60 p-4 dark:border-rose-500/20 dark:bg-rose-500/5">
            <p class="font-semibold text-rose-900 dark:text-rose-100">{{ __('site.bands.once_title') }}</p>
            <p class="mt-1 text-sm leading-relaxed text-rose-800/80 dark:text-rose-100/70">{{ __('site.bands.once_text') }}</p>
        </div>

        <h2 class="doc-h2">{{ __('site.bands.pages_title') }}</h2>
        <p class="doc-p">{{ __('site.bands.pages_text') }}</p>

        <figure class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-white/10 dark:bg-white/5">
            <a href="{{ asset('images/docs/bands-packing-list.png') }}" target="_blank" rel="noopener" class="block">
                <img
                    src="{{ asset('images/docs/bands-packing-list.png') }}"
                    alt="{{ __('site.bands.pages_alt') }}"
                    class="mx-auto block w-full max-w-md"
                >
            </a>
            <figcaption class="border-t border-slate-200 px-4 py-3 text-xs text-slate-500 dark:border-white/10 dark:text-slate-400">
                {{ __('site.bands.pages_caption') }}
            </figcaption>
        </figure>

        <div class="mt-4 flex flex-wrap gap-x-5 gap-y-2 text-sm text-slate-600 dark:text-slate-300">
            @foreach ($pagesLegend as $key => $tone)
                <span class="inline-flex items-center gap-2">
                    <span class="h-2.5 w-2.5 rounded-full {{ $toneDot[$tone] }}"></span>
                    {{ __("site.bands.pages_legend.{$key}") }}
                </span>
            @endforeach
        </div>

        <h2 class="doc-h2">{{ __('site.bands.code_title') }}</h2>
        <p class="doc-p">{{ __('site.bands.code_text') }}</p>

        <div class="mt-4">
            <x-ui.code
                :tabs="[
                    ['path' => 'app/Reports/PriceList/Report.php', 'label' => 'Report.php', 'lang' => 'php'],
                    ['path' => 'app/Reports/PriceList/views/report-start.blade.php', 'label' => 'views/report-start.blade.php', 'lang' => 'blade'],
                    ['path' => 'app/Reports/PriceList/views/grid-head.blade.php', 'label' => 'views/grid-head.blade.php', 'lang' => 'blade'],
                    ['path' => 'app/Reports/PriceList/views/row.blade.php', 'label' => 'views/row.blade.php', 'lang' => 'blade'],
                    ['path' => 'app/Reports/PriceList/views/report-end.blade.php', 'label' => 'views/report-end.blade.php', 'lang' => 'blade'],
                ]"
                :caption="__('site.bands.code_caption')"
            />
        </div>

        <div class="mt-12 grid gap-4 sm:grid-cols-2">
            <a
                href="{{ route('examples.show', ['key' => 'price_list']) }}"
                class="group rounded-2xl border border-slate-200 bg-white p-6 transition hover:border-teal-300 hover:shadow-sm dark:border-white/10 dark:bg-white/5 dark:hover:border-teal-500/40"
            >
                <span class="block font-semibold text-slate-900 dark:text-white">{{ __('site.bands.example_link') }}</span>
                <span class="mt-1 block text-sm text-slate-600 dark:text-slate-300">{{ __('site.bands.example_link_text') }}</span>
            </a>

            <a
                href="{{ route('docs.show', ['page' => 'report-types']) }}"
                class="group rounded-2xl border border-slate-200 bg-white p-6 transition hover:border-teal-300 hover:shadow-sm dark:border-white/10 dark:bg-white/5 dark:hover:border-teal-500/40"
            >
                <span class="block font-semibold text-slate-900 dark:text-white">{{ __('site.bands.next') }} · {{ __('site.docs.pages.report-types') }}</span>
                <span class="mt-1 block text-sm text-slate-600 dark:text-slate-300">{{ __('site.bands.next_text') }}</span>
            </a>
        </div>
    </article>
@endsection
