@extends('layouts.docs')

@section('title', __('site.report-definition.title').' · Laravel Reports')
@section('description', __('site.report-definition.lead'))

@section('sidebar')
    <x-docs.sidebar />
@endsection

@section('content')
    <article class="max-w-4xl">
        <h1 class="doc-title">{{ __('site.report-definition.title') }}</h1>
        <p class="doc-lead">{{ __('site.report-definition.lead') }}</p>

        <h2 class="doc-h2">{{ __('site.report-definition.class_title') }}</h2>
        <p class="doc-p">{{ __('site.report-definition.class_lead') }}</p>

        <x-docs.api-table :rows="trans('site.report-definition.hooks')" />

        <div class="mt-4 rounded-xl border border-amber-200 bg-amber-50/60 p-4 dark:border-amber-500/20 dark:bg-amber-500/5">
            <p class="text-sm leading-relaxed text-amber-900 dark:text-amber-100/80">{{ __('site.report-definition.class_note') }}</p>
        </div>

        <div class="mt-6">
            <x-ui.code
                :tabs="['app/Reports/PriceList/Report.php']"
                :caption="__('site.report-definition.class_caption')"
            />
        </div>

        <h2 class="doc-h2">{{ __('site.report-definition.builder_title') }}</h2>
        <p class="doc-p">{{ __('site.report-definition.builder_lead') }}</p>

        <x-docs.api-table :rows="trans('site.report-definition.builder')" />

        <h2 class="doc-h2">{{ __('site.report-definition.bands_title') }}</h2>
        <p class="doc-p">{{ __('site.report-definition.bands_lead') }}</p>

        <x-docs.api-table :rows="trans('site.report-definition.band')" />

        <h3 class="doc-h3">{{ __('site.report-definition.detail_title') }}</h3>
        <p class="doc-p">{{ __('site.report-definition.detail_lead') }}</p>

        <x-docs.api-table :rows="trans('site.report-definition.detail')" />

        <div class="mt-6">
            <x-ui.code
                :tabs="[
                    ['path' => 'app/Reports/PackingList/Report.php', 'label' => 'PackingList/Report.php', 'lang' => 'php'],
                    ['path' => 'app/Reports/LabelSheet/Report.php', 'label' => 'LabelSheet/Report.php', 'lang' => 'php'],
                ]"
                :caption="__('site.report-definition.bands_caption')"
            />
        </div>

        <h2 class="doc-h2">{{ __('site.report-definition.page_setup_title') }}</h2>
        <p class="doc-p">{{ __('site.report-definition.page_setup_lead') }}</p>

        <x-docs.api-table :rows="trans('site.report-definition.page_setup')" />

        <div class="mt-4 rounded-xl border border-slate-200 bg-slate-50/70 p-4 dark:border-white/10 dark:bg-white/5">
            <p class="text-sm leading-relaxed text-slate-700 dark:text-slate-300">{{ __('site.report-definition.page_setup_note') }}</p>
        </div>

        <h2 class="doc-h2">{{ __('site.report-definition.context_title') }}</h2>
        <p class="doc-p">{{ __('site.report-definition.context_lead') }}</p>

        <h3 class="doc-h3">{{ __('site.report-definition.context_props_title') }}</h3>
        <x-docs.api-table :rows="trans('site.report-definition.context_props')" />

        <h3 class="doc-h3">{{ __('site.report-definition.context_methods_title') }}</h3>
        <x-docs.api-table :rows="trans('site.report-definition.context_methods')" />

        <div class="mt-4 rounded-xl border border-teal-200 bg-teal-50/60 p-4 dark:border-teal-500/20 dark:bg-teal-500/5">
            <p class="text-sm leading-relaxed text-teal-900 dark:text-teal-100/80">{{ __('site.report-definition.context_note') }}</p>
        </div>

        <div class="mt-6">
            <x-ui.code
                :tabs="[
                    ['path' => 'app/Reports/PriceList/views/row.blade.php', 'label' => 'views/row.blade.php', 'lang' => 'blade'],
                    ['path' => 'app/Reports/PriceList/views/category-foot.blade.php', 'label' => 'views/category-foot.blade.php', 'lang' => 'blade'],
                    ['path' => 'app/Reports/PriceList/views/report-end.blade.php', 'label' => 'views/report-end.blade.php', 'lang' => 'blade'],
                ]"
                :caption="__('site.report-definition.context_caption')"
            />
        </div>

        <a
            href="{{ route('docs.show', ['page' => 'source']) }}"
            class="mt-12 flex items-center justify-between gap-4 rounded-2xl border border-slate-200 bg-white p-6 transition hover:border-teal-300 hover:shadow-sm dark:border-white/10 dark:bg-white/5 dark:hover:border-teal-500/40"
        >
            <span>
                <span class="block font-semibold text-slate-900 dark:text-white">{{ __('site.report-definition.next') }} · {{ __('site.docs.pages.source') }}</span>
                <span class="mt-1 block text-sm text-slate-600 dark:text-slate-300">{{ __('site.report-definition.next_text') }}</span>
            </span>
            <svg class="h-5 w-5 shrink-0 text-teal-600 dark:text-teal-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12h14m-6-6 6 6-6 6" /></svg>
        </a>
    </article>
@endsection
