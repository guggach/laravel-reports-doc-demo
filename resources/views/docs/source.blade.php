@extends('layouts.docs')

@section('title', __('site.source.title').' · Laravel Reports')
@section('description', __('site.source.lead'))

@php
    $databaseSourceTabs = [[
        'label' => 'database sources',
        'lang' => 'php',
        'code' => <<<'PHP'
use App\Models\Customer;
use Guggach\Reports\Sources\EloquentSource;
use Guggach\Reports\Sources\QuerySource;
use Guggach\Reports\Sources\RawSqlSource;
use Guggach\Reports\Sources\ReportField;

// The field DTOs are a normal PHP variable. They are optional for every
// source: without them there is no filter/sort allow-list.
$fields = [
    new ReportField('id', 'ID', type: 'id'),
    new ReportField('name', 'Name'),
    new ReportField('revenue', 'Revenue', type: 'number'),
    new ReportField('active', 'Active', type: 'boolean'),
];

// Eloquent: model, builder or model class name
new EloquentSource(
    Customer::query()->where('active', true),
    fields: $fields,
);

// Query builder: DB::table()
new QuerySource(
    DB::table('customers')->where('active', true),
    fields: $fields,
);

// Raw SQL: SQL and bindings stay developer-owned
new RawSqlSource(
    'select id, name, revenue from customers where active = ?',
    [1],
    fields: $fields,
    connection: 'reporting',
);
PHP,
    ], 'app/Reports/PriceList/Source.php'];

    $filterTabs = [[
        'label' => 'filterControls()',
        'lang' => 'php',
        'code' => <<<'PHP'
public function filterControls(): array
{
    return FilterBuilder::for($this->source())
        ->field('price')->operators(['=', '>=', '<=', 'between', 'in'])
        ->field('category')->multiselect()
        ->field('supplier')->picker(valueField: 'id', labelField: 'label')
        ->build();
}
PHP,
    ], 'app/Reports/PriceList/Source.php'];
@endphp

@section('sidebar')
    <x-docs.sidebar />
@endsection

@section('content')
    <article class="max-w-4xl">
        <h1 class="doc-title">{{ __('site.source.title') }}</h1>
        <p class="doc-lead">{{ __('site.source.lead') }}</p>

        <h2 class="doc-h2">{{ __('site.source.contract_title') }}</h2>
        <p class="doc-p">{{ __('site.source.contract_lead') }}</p>

        <x-docs.api-table :rows="trans('site.source.contract')" />

        <div class="mt-4 rounded-xl border border-amber-200 bg-amber-50/60 p-4 dark:border-amber-500/20 dark:bg-amber-500/5">
            <p class="text-sm leading-relaxed text-amber-900 dark:text-amber-100/80">{{ __('site.source.contract_note') }}</p>
        </div>

        <h2 class="doc-h2">{{ __('site.source.types_title') }}</h2>
        <p class="doc-p">{{ __('site.source.types_lead') }}</p>

        <x-docs.api-table :rows="trans('site.source.types')" />

        <div class="mt-6">
            <x-ui.code :tabs="$databaseSourceTabs" :caption="__('site.source.types_caption')" />
        </div>

        <div class="mt-4 rounded-xl border border-amber-200 bg-amber-50/60 p-4 dark:border-amber-500/20 dark:bg-amber-500/5">
            <p class="font-semibold text-amber-900 dark:text-amber-100">{{ __('site.source.fields_optional_title') }}</p>
            <p class="mt-1 text-sm leading-relaxed text-amber-800/80 dark:text-amber-100/70">{{ __('site.source.fields_optional_text') }}</p>
        </div>

        <h2 class="doc-h2">{{ __('site.source.fields_title') }}</h2>
        <p class="doc-p">{{ __('site.source.fields_lead') }}</p>

        <x-docs.api-table :rows="trans('site.source.field_props')" />

        <h3 class="doc-h3">{{ __('site.source.field_types_title') }}</h3>
        <p class="doc-p">{{ __('site.source.field_types_lead') }}</p>

        <x-docs.api-table :rows="trans('site.source.field_types')" />

        <h2 class="doc-h2">{{ __('site.source.parameters_title') }}</h2>
        <p class="doc-p">{{ __('site.source.parameters_lead') }}</p>

        <x-docs.api-table :rows="trans('site.source.parameters')" />

        <h2 class="doc-h2">{{ __('site.source.pipeline_title') }}</h2>
        <p class="doc-p">{{ __('site.source.pipeline_lead') }}</p>

        <x-docs.api-table :rows="trans('site.source.pipeline')" />

        <div class="mt-4 rounded-xl border border-rose-200 bg-rose-50/60 p-4 dark:border-rose-500/20 dark:bg-rose-500/5">
            <p class="font-semibold text-rose-900 dark:text-rose-100">{{ __('site.source.sort_title') }}</p>
            <p class="mt-1 text-sm leading-relaxed text-rose-800/80 dark:text-rose-100/70">{{ __('site.source.sort_text') }}</p>
        </div>

        <h2 class="doc-h2">{{ __('site.source.filters_title') }}</h2>
        <p class="doc-p">{{ __('site.source.filters_lead') }}</p>

        <x-docs.api-table :rows="trans('site.source.filter_builder')" />

        <h3 class="doc-h3">{{ __('site.source.operators_title') }}</h3>
        <p class="doc-p">{{ __('site.source.operators_lead') }}</p>

        <x-docs.api-table :rows="trans('site.source.operators')" />

        <div class="mt-6">
            <x-ui.code :tabs="$filterTabs" :caption="__('site.source.filters_caption')" />
        </div>

        <a
            href="{{ route('docs.show', ['page' => 'groups']) }}"
            class="mt-12 flex items-center justify-between gap-4 rounded-2xl border border-slate-200 bg-white p-6 transition hover:border-teal-300 hover:shadow-sm dark:border-white/10 dark:bg-white/5 dark:hover:border-teal-500/40"
        >
            <span>
                <span class="block font-semibold text-slate-900 dark:text-white">{{ __('site.source.next') }} · {{ __('site.docs.pages.groups') }}</span>
                <span class="mt-1 block text-sm text-slate-600 dark:text-slate-300">{{ __('site.source.next_text') }}</span>
            </span>
            <svg class="h-5 w-5 shrink-0 text-teal-600 dark:text-teal-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12h14m-6-6 6 6-6 6" /></svg>
        </a>
    </article>
@endsection
