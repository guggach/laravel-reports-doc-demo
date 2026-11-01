@extends('layouts.docs')

@section('title', __('site.filters.title').' · Laravel Reports')
@section('description', __('site.filters.lead'))

@php
    $queryTabs = [[
        'label' => 'query strings',
        'lang' => 'text',
        'code' => <<<'TEXT'
# text (default operator: like)
/reports/price_list/run?name=Kaffee

# text with an explicit operator
/reports/price_list/run?name[operator]=like&name[value]=Kaffee

# number: greater or equal
/reports/price_list/run?price[operator]=>=&price[value][]=50

# number: between
/reports/price_list/run?price[operator]=between&price[value][]=50&price[value][]=100

# enum / multiselect / picker
/reports/price_list/run?category=K%C3%BCche
/reports/price_list/run?category[]=K%C3%BCche&category[]=B%C3%BCro
/reports/price_list/run?supplier[]=1&supplier[]=2
TEXT,
    ]];

    $manualFormTabs = [[
        'label' => 'Blade form',
        'lang' => 'blade',
        'code' => <<<'BLADE'
<form method="GET" action="{{ route('reports.preview', ['name' => 'price_list']) }}" target="_blank">
    <select name="category">
        <option value="">Alle Kategorien</option>
        <option value="Küche">Küche</option>
        <option value="Büro">Büro</option>
    </select>

    <input type="text" name="name" placeholder="Bezeichnung enthält …">

    <select name="price[operator]">
        <option value="=">=</option>
        <option value=">=">≥</option>
        <option value="<=">≤</option>
        <option value="between">zwischen</option>
    </select>
    <input type="number" step="any" name="price[value][]" placeholder="von">
    <input type="number" step="any" name="price[value][]" placeholder="bis">

    <button type="submit">Vorschau öffnen</button>
</form>
BLADE,
    ], [
        'label' => 'Controller',
        'lang' => 'php',
        'code' => <<<'PHP'
use Guggach\Reports\Facades\Reports;
use Guggach\Reports\Filters\FilterValidator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class PriceListController
{
    public function __invoke(Request $request): Response
    {
        $report = Reports::find('price_list');

        // Same allow-list and operator normalisation as the package routes.
        $filters = (new FilterValidator($report->filterControls()))
            ->validate($request->query())
            ->all();

        return response(Reports::html($report, $filters));
    }
}
PHP,
    ]];
@endphp

@section('sidebar')
    <x-docs.sidebar />
@endsection

@section('content')
    <article class="max-w-4xl">
        <h1 class="doc-title">{{ __('site.filters.title') }}</h1>
        <p class="doc-lead">{{ __('site.filters.lead') }}</p>

        <h2 class="doc-h2">{{ __('site.filters.how_title') }}</h2>
        <p class="doc-p">{{ __('site.filters.how_lead') }}</p>

        <x-docs.api-table :rows="trans('site.filters.how')" />

        <div class="mt-4 rounded-xl border border-amber-200 bg-amber-50/60 p-4 dark:border-amber-500/20 dark:bg-amber-500/5">
            <p class="font-semibold text-amber-900 dark:text-amber-100">{{ __('site.filters.no_controls_title') }}</p>
            <p class="mt-1 text-sm leading-relaxed text-amber-800/80 dark:text-amber-100/70">{{ __('site.filters.no_controls_text') }}</p>
        </div>

        <h2 class="doc-h2">{{ __('site.filters.demo_title') }}</h2>
        <p class="doc-p">{{ __('site.filters.demo_lead') }}</p>

        <div class="mt-6">
            <x-ui.preview
                :src="route('reports.form', ['name' => 'price_list'])"
                :open="route('reports.form', ['name' => 'price_list'])"
                :title="__('site.filters.demo_frame_title')"
                height="40rem"
            />
        </div>

        <p class="mt-3 text-sm text-slate-500 dark:text-slate-400">{{ __('site.filters.demo_note') }}</p>

        <h2 class="doc-h2">{{ __('site.filters.fields_title') }}</h2>
        <p class="doc-p">{{ __('site.filters.fields_lead') }}</p>

        <x-docs.api-table :rows="trans('site.filters.fields')" />

        <h2 class="doc-h2">{{ __('site.filters.query_title') }}</h2>
        <p class="doc-p">{{ __('site.filters.query_lead') }}</p>

        <div class="mt-4">
            <x-ui.code :tabs="$queryTabs" :caption="__('site.filters.query_caption')" />
        </div>

        <h2 class="doc-h2">{{ __('site.filters.apply_title') }}</h2>
        <p class="doc-p">{{ __('site.filters.apply_lead') }}</p>

        <x-docs.api-table :rows="trans('site.filters.apply')" />

        <div class="mt-4 rounded-xl border border-teal-200 bg-teal-50/60 p-4 dark:border-teal-500/20 dark:bg-teal-500/5">
            <p class="text-sm leading-relaxed text-teal-900 dark:text-teal-100/80">{{ __('site.filters.apply_note') }}</p>
        </div>

        <h2 class="doc-h2">{{ __('site.filters.manual_title') }}</h2>
        <p class="doc-p">{{ __('site.filters.manual_lead') }}</p>

        <form
            method="GET"
            action="{{ route('reports.preview', ['name' => 'price_list']) }}"
            target="_blank"
            class="mt-6 rounded-2xl border border-slate-200 bg-white p-5 dark:border-white/10 dark:bg-white/5"
        >
            <div class="grid gap-4 sm:grid-cols-2">
                <label class="block">
                    <span class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('site.filters.form_category') }}</span>
                    <select name="category" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 dark:border-white/15 dark:bg-slate-900 dark:text-white">
                        <option value="">{{ __('site.filters.form_all') }}</option>
                        <option value="Küche">Küche</option>
                        <option value="Büro">Büro</option>
                    </select>
                </label>

                <label class="block">
                    <span class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('site.filters.form_name') }}</span>
                    <input type="text" name="name" placeholder="{{ __('site.filters.form_name_placeholder') }}" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 dark:border-white/15 dark:bg-slate-900 dark:text-white">
                </label>

                <label class="block">
                    <span class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('site.filters.form_operator') }}</span>
                    <select name="price[operator]" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 dark:border-white/15 dark:bg-slate-900 dark:text-white">
                        <option value="=">=</option>
                        <option value=">=">≥</option>
                        <option value="<=">≤</option>
                        <option value="between">{{ __('site.filters.form_between') }}</option>
                    </select>
                </label>

                <div class="grid grid-cols-2 gap-3">
                    <label class="block">
                        <span class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('site.filters.form_from') }}</span>
                        <input type="number" step="any" name="price[value][]" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 dark:border-white/15 dark:bg-slate-900 dark:text-white">
                    </label>
                    <label class="block">
                        <span class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('site.filters.form_to') }}</span>
                        <input type="number" step="any" name="price[value][]" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 dark:border-white/15 dark:bg-slate-900 dark:text-white">
                    </label>
                </div>
            </div>

            <div class="mt-5 flex flex-wrap items-center gap-3">
                <button type="submit" class="rounded-lg bg-teal-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-teal-700">
                    {{ __('site.filters.form_submit') }}
                </button>
                <button
                    type="submit"
                    formaction="{{ route('reports.pdf', ['name' => 'price_list']) }}"
                    class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-white/15 dark:text-slate-200 dark:hover:bg-white/5"
                >
                    {{ __('site.filters.form_pdf') }}
                </button>
                <button type="reset" class="text-sm font-medium text-slate-500 transition hover:text-slate-800 dark:text-slate-400 dark:hover:text-white">
                    {{ __('site.filters.form_reset') }}
                </button>
            </div>
        </form>

        <div class="mt-6">
            <x-ui.code :tabs="$manualFormTabs" :caption="__('site.filters.manual_caption')" />
        </div>

        <h2 class="doc-h2">{{ __('site.filters.customize_title') }}</h2>
        <p class="doc-p">{{ __('site.filters.customize_lead') }}</p>

        <x-docs.api-table :rows="trans('site.filters.customize')" />

        <div class="mt-6">
            <x-ui.code
                :tabs="[[
                    'label' => 'filterControls()',
                    'lang' => 'php',
                    'code' => <<<'PHP'
use Guggach\Reports\Filters\FilterBuilder;

public function filterControls(): array
{
    return FilterBuilder::for($this->source())
        ->field('price')->operators(['=', '>=', '<=', 'between'])
        ->field('category')->multiselect()
        ->field('supplier')->picker(valueField: 'id', labelField: 'label')
        ->build();
}
PHP,
                ]]"
                :caption="__('site.filters.customize_caption')"
            />
        </div>

        <div class="mt-4 rounded-xl border border-slate-200 bg-slate-50/70 p-4 dark:border-white/10 dark:bg-white/5">
            <p class="text-sm leading-relaxed text-slate-700 dark:text-slate-300">{{ __('site.filters.customize_note') }}</p>
        </div>

        <div class="mt-12 grid gap-4 sm:grid-cols-2">
            <a
                href="{{ route('docs.show', ['page' => 'routing']) }}"
                class="group rounded-2xl border border-slate-200 bg-white p-6 transition hover:border-teal-300 hover:shadow-sm dark:border-white/10 dark:bg-white/5 dark:hover:border-teal-500/40"
            >
                <span class="block font-semibold text-slate-900 dark:text-white">{{ __('site.filters.back_routing') }} · {{ __('site.docs.pages.routing') }}</span>
                <span class="mt-1 block text-sm text-slate-600 dark:text-slate-300">{{ __('site.filters.back_routing_text') }}</span>
            </a>

            <a
                href="{{ route('docs.show', ['page' => 'source']) }}"
                class="group rounded-2xl border border-slate-200 bg-white p-6 transition hover:border-teal-300 hover:shadow-sm dark:border-white/10 dark:bg-white/5 dark:hover:border-teal-500/40"
            >
                <span class="block font-semibold text-slate-900 dark:text-white">{{ __('site.filters.back_source') }} · {{ __('site.docs.pages.source') }}</span>
                <span class="mt-1 block text-sm text-slate-600 dark:text-slate-300">{{ __('site.filters.back_source_text') }}</span>
            </a>
        </div>
    </article>
@endsection
