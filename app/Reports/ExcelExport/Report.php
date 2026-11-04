<?php

declare(strict_types=1);

namespace App\Reports\ExcelExport;

use App\Models\DemoOrder;
use App\Reports\Layout\CompanyLayout;
use Guggach\Reports\Aggregates\Sum;
use Guggach\Reports\Definition\ReportBuilder;
use Guggach\Reports\Filters\FilterBuilder;
use Guggach\Reports\Filters\FilterControl;
use Guggach\Reports\Report as BaseReport;
use Guggach\Reports\Sources\EloquentSource;
use Guggach\Reports\Sources\ReportField;
use Guggach\Reports\Sources\ReportSource;

/**
 * Flat order list used by the Excel export example. The same source and field
 * metadata drive the HTML/PDF preview and the typed XLSX workbook.
 */
final class Report extends BaseReport
{
    public function key(): string
    {
        return 'excel_export';
    }

    public function name(): string
    {
        return __('excel_export::report.name');
    }

    public function layout(): string
    {
        return CompanyLayout::class;
    }

    public function currency(): string
    {
        return 'CHF';
    }

    public function source(): ReportSource
    {
        return (new EloquentSource(
            DemoOrder::query()->orderBy('ordered_at')->orderBy('order_number'),
            $this->fields(),
        ))->withSorts(['ordered_at' => 'asc']);
    }

    /**
     * @return list<FilterControl>
     */
    public function filterControls(): array
    {
        return FilterBuilder::for($this->source())
            ->field('category')->select()
            ->field('status')->select()
            ->only(['category', 'status'])
            ->build();
    }

    public function define(ReportBuilder $r): void
    {
        $r->reportStart(view: 'report-start');
        $r->gridHeader(view: 'grid-head');
        $r->detail(view: 'row');
        $r->reportEnd(view: 'report-end');

        $r->aggregate('total', Sum::class, field: 'amount', scope: 'report');
    }

    /**
     * @return list<ReportField>
     */
    private function fields(): array
    {
        return [
            new ReportField('order_number', __('excel_export::report.columns.order'), filterable: false),
            new ReportField('customer', __('excel_export::report.columns.customer')),
            new ReportField('category', __('excel_export::report.columns.category'), type: 'enum', options: [
                'Miete' => __('excel_export::report.categories.rent'),
                'Service' => __('excel_export::report.categories.service'),
                'Verkauf' => __('excel_export::report.categories.sale'),
            ]),
            new ReportField('amount', __('excel_export::report.columns.amount'), type: 'number', format: 'currency:CHF', aggregatable: true),
            new ReportField('ordered_at', __('excel_export::report.columns.ordered_at'), type: 'date', format: 'date'),
            new ReportField('status', __('excel_export::report.columns.status'), type: 'enum', options: [
                'offen' => __('excel_export::report.status.open'),
                'bezahlt' => __('excel_export::report.status.paid'),
            ]),
        ];
    }
}
