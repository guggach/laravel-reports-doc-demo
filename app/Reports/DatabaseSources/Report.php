<?php

declare(strict_types=1);

namespace App\Reports\DatabaseSources;

use App\Models\DemoOrder;
use Guggach\Reports\Aggregates\Count;
use Guggach\Reports\Aggregates\Sum;
use Guggach\Reports\Definition\ReportBuilder;
use Guggach\Reports\Filters\FilterBuilder;
use Guggach\Reports\Filters\FilterControl;
use Guggach\Reports\Report as BaseReport;
use Guggach\Reports\Sources\ArraySource;
use Guggach\Reports\Sources\CollectionSource;
use Guggach\Reports\Sources\EloquentSource;
use Guggach\Reports\Sources\QuerySource;
use Guggach\Reports\Sources\RawSqlSource;
use Guggach\Reports\Sources\ReportField;
use Guggach\Reports\Sources\ReportSource;
use Illuminate\Support\Facades\DB;

/**
 * SQLite-backed demo: the same report can be rendered through every source
 * adapter. Pick the source in the generated filter form; the report start band
 * shows which adapter is active.
 */
final class Report extends BaseReport
{
    /** @var array<string, string> */
    private const SOURCE_LABELS = [
        'query' => 'QuerySource · DB::table()',
        'eloquent' => 'EloquentSource · Model',
        'raw_sql' => 'RawSqlSource · SQL + Bindings',
        'collection' => 'CollectionSource · Collection',
        'array' => 'ArraySource · Array',
    ];

    public function key(): string
    {
        return 'database_sources';
    }

    public function name(): string
    {
        return 'Datenquellen (SQLite)';
    }

    public function layout(): string
    {
        return 'default';
    }

    public function source(): ReportSource
    {
        $fields = $this->dataFields();

        $source = match ($this->selectedSource()) {
            'eloquent' => new EloquentSource(DemoOrder::class, $fields),
            'raw_sql' => new RawSqlSource('select * from demo_orders', [], $fields),
            'collection' => new CollectionSource(DemoOrder::all(), $fields),
            'array' => new ArraySource(DemoOrder::all()->toArray(), $fields),
            default => new QuerySource(DB::table('demo_orders'), $fields),
        };

        return $source
            ->withFilters($this->filters())
            ->withSorts(['amount' => 'desc']);
    }

    /**
     * @return list<FilterControl>
     */
    public function filterControls(): array
    {
        $sourceControl = new FilterControl(
            key: 'source',
            label: 'Quelle',
            control: 'select',
            type: 'enum',
            operators: ['='],
            defaultOperator: '=',
            options: self::SOURCE_LABELS,
            required: true,
        );

        return [
            $sourceControl,
            ...FilterBuilder::for($this->dataFields())->build(),
        ];
    }

    public function define(ReportBuilder $r): void
    {
        $r->reportStart(view: 'report-start');
        $r->gridHeader(view: 'grid-head');
        $r->detail(view: 'row');
        $r->reportEnd(view: 'report-end');

        $r->aggregate('total', Sum::class, field: 'amount', scope: 'report');
        $r->aggregate('orders', Count::class, field: 'order_number', scope: 'report');
    }

    /**
     * @return array<string, string>
     */
    public static function sourceLabels(): array
    {
        return self::SOURCE_LABELS;
    }

    /**
     * @return list<ReportField>
     */
    private function dataFields(): array
    {
        return [
            new ReportField('order_number', 'Auftrag'),
            new ReportField('customer', 'Kunde'),
            new ReportField('category', 'Kategorie', type: 'enum', options: [
                'Miete' => 'Miete',
                'Service' => 'Service',
                'Verkauf' => 'Verkauf',
            ]),
            new ReportField('amount', 'Betrag', type: 'number', aggregatable: true),
            new ReportField('ordered_at', 'Datum', type: 'date'),
            new ReportField('status', 'Status', type: 'enum', options: [
                'offen' => 'offen',
                'bezahlt' => 'bezahlt',
            ]),
        ];
    }

    private function selectedSource(): string
    {
        $raw = $this->filters()['source'] ?? 'query';

        if (is_array($raw)) {
            $raw = $raw['value'] ?? $raw[0] ?? 'query';
        }

        return is_string($raw) && array_key_exists($raw, self::SOURCE_LABELS) ? $raw : 'query';
    }
}
