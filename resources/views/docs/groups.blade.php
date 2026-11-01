@extends('layouts.docs')

@section('title', __('site.groups.title').' · Laravel Reports')
@section('description', __('site.groups.lead'))

@php
    $nestedGroupTabs = [[
        'label' => 'nested groups',
        'lang' => 'php',
        'code' => <<<'PHP'
$r->group('category', function ($category): void {
    $category->header(view: 'category-head');
    $category->footer(view: 'category-foot');
    $category->aggSum('price', as: 'category_total');

    // Second level: a group inside a group.
    $category->group('supplier', function ($supplier): void {
        $supplier->header(view: 'supplier-head');
        $supplier->aggSum('price', as: 'supplier_total');
    });
});

// Composite key: one group per category + currency combination.
$r->group(['category', 'currency'], function ($group): void {
    $group->header(view: 'group-head');
});
PHP,
    ], 'app/Reports/PriceList/Report.php'];

    $aggregateTabs = [[
        'label' => 'report aggregates',
        'lang' => 'php',
        'code' => <<<'PHP'
use Guggach\Reports\Aggregates\Avg;
use Guggach\Reports\Aggregates\Count;
use Guggach\Reports\Aggregates\Max;
use Guggach\Reports\Aggregates\Sum;

public function define(ReportBuilder $r): void
{
    // ...

    // Report-wide: available in the report end band (and cumulatively
    // while the detail rows are rendered).
    $r->aggregate('grand_total', Sum::class, field: 'price');
    $r->aggregate('average_price', Avg::class, field: 'price');
    $r->aggregate('position_count', Count::class);
    $r->aggregate('highest_price', Max::class, field: 'price');

    $r->group('category', function ($g): void {
        // Group-wide: available in the group footer.
        $g->aggSum('price', as: 'category_total');
        $g->aggregate(['type' => 'count', 'field' => 'sku', 'as' => 'category_count']);
    });
}
PHP,
    ], [
        'label' => 'views',
        'lang' => 'blade',
        'code' => <<<'BLADE'
{{-- Group footer: group + report aggregates --}}
<tr>
    <td colspan="2">Summe {{ $ctx->currentGroup()['key'] }}</td>
    <td style="text-align:right">
        {{ number_format((float) $ctx->aggregates['category_total'], 2, '.', "'") }}
    </td>
</tr>

{{-- Report end: report aggregates --}}
<p>{{ $ctx->total }} Positionen,
   Gesamt {{ number_format((float) $ctx->aggregates['grand_total'], 2, '.', "'") }}</p>
BLADE,
    ]];
@endphp

@section('sidebar')
    <x-docs.sidebar />
@endsection

@section('content')
    <article class="max-w-4xl">
        <h1 class="doc-title">{{ __('site.groups.title') }}</h1>
        <p class="doc-lead">{{ __('site.groups.lead') }}</p>

        <h2 class="doc-h2">{{ __('site.groups.define_title') }}</h2>
        <p class="doc-p">{{ __('site.groups.define_lead') }}</p>

        <x-docs.api-table :rows="trans('site.groups.define')" />

        <div class="mt-6">
            <x-ui.code :tabs="$nestedGroupTabs" :caption="__('site.groups.define_caption')" />
        </div>

        <h2 class="doc-h2">{{ __('site.groups.bands_title') }}</h2>
        <p class="doc-p">{{ __('site.groups.bands_lead') }}</p>

        <x-docs.api-table :rows="trans('site.groups.bands')" />

        <div class="mt-6">
            <x-ui.code
                :tabs="[
                    ['path' => 'app/Reports/PriceList/views/category-head.blade.php', 'label' => 'views/category-head.blade.php', 'lang' => 'blade'],
                    ['path' => 'app/Reports/PriceList/views/category-foot.blade.php', 'label' => 'views/category-foot.blade.php', 'lang' => 'blade'],
                ]"
                :caption="__('site.groups.bands_caption')"
            />
        </div>

        <h2 class="doc-h2">{{ __('site.groups.aggregates_title') }}</h2>
        <p class="doc-p">{{ __('site.groups.aggregates_lead') }}</p>

        <h3 class="doc-h3">{{ __('site.groups.group_aggregates_title') }}</h3>
        <p class="doc-p">{{ __('site.groups.group_aggregates_lead') }}</p>

        <x-docs.api-table :rows="trans('site.groups.group_aggregates')" />

        <h3 class="doc-h3">{{ __('site.groups.aggregate_types_title') }}</h3>
        <p class="doc-p">{{ __('site.groups.aggregate_types_lead') }}</p>

        <x-docs.api-table :rows="trans('site.groups.aggregate_types')" />

        <h3 class="doc-h3">{{ __('site.groups.report_aggregates_title') }}</h3>
        <p class="doc-p">{{ __('site.groups.report_aggregates_lead') }}</p>

        <x-docs.api-table :rows="trans('site.groups.report_aggregates')" />

        <div class="mt-6">
            <x-ui.code :tabs="$aggregateTabs" :caption="__('site.groups.aggregates_caption')" />
        </div>

        <h3 class="doc-h3">{{ __('site.groups.availability_title') }}</h3>
        <p class="doc-p">{{ __('site.groups.availability_lead') }}</p>

        <x-docs.api-table :rows="trans('site.groups.availability')" />

        <h2 class="doc-h2">{{ __('site.groups.sorting_title') }}</h2>
        <p class="doc-p">{{ __('site.groups.sorting_lead') }}</p>

        <div class="mt-4 rounded-xl border border-rose-200 bg-rose-50/60 p-4 dark:border-rose-500/20 dark:bg-rose-500/5">
            <p class="font-semibold text-rose-900 dark:text-rose-100">{{ __('site.groups.sorting_note_title') }}</p>
            <p class="mt-1 text-sm leading-relaxed text-rose-800/80 dark:text-rose-100/70">{{ __('site.groups.sorting_note') }}</p>
        </div>

        <h2 class="doc-h2">{{ __('site.groups.reserved_title') }}</h2>
        <p class="doc-p">{{ __('site.groups.reserved_lead') }}</p>

        <x-docs.api-table :rows="trans('site.groups.reserved')" />

        <div class="mt-12 grid gap-4 sm:grid-cols-2">
            <a
                href="{{ route('examples.show', ['key' => 'price_list']) }}"
                class="group rounded-2xl border border-slate-200 bg-white p-6 transition hover:border-teal-300 hover:shadow-sm dark:border-white/10 dark:bg-white/5 dark:hover:border-teal-500/40"
            >
                <span class="block font-semibold text-slate-900 dark:text-white">{{ __('site.groups.example_link') }}</span>
                <span class="mt-1 block text-sm text-slate-600 dark:text-slate-300">{{ __('site.groups.example_link_text') }}</span>
            </a>

            <a
                href="{{ route('docs.show', ['page' => 'filters']) }}"
                class="group rounded-2xl border border-slate-200 bg-white p-6 transition hover:border-teal-300 hover:shadow-sm dark:border-white/10 dark:bg-white/5 dark:hover:border-teal-500/40"
            >
                <span class="block font-semibold text-slate-900 dark:text-white">{{ __('site.groups.back') }} · {{ __('site.docs.pages.filters') }}</span>
                <span class="mt-1 block text-sm text-slate-600 dark:text-slate-300">{{ __('site.groups.back_text') }}</span>
            </a>
        </div>
    </article>
@endsection
