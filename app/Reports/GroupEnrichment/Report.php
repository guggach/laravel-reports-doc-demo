<?php

declare(strict_types=1);

namespace App\Reports\GroupEnrichment;

use App\Models\DemoOrder;
use Guggach\Reports\Aggregates\Sum;
use Guggach\Reports\Definition\ReportBuilder;
use Guggach\Reports\Report as BaseReport;
use Guggach\Reports\Sources\EloquentSource;
use Guggach\Reports\Sources\ReportField;
use Guggach\Reports\Sources\ReportSource;

/**
 * Grouped sales report. The detail rows come from demo_orders; each category
 * header loads its translated name and target from demo_categories through an
 * Eloquent enrichment source. The switch in the preview header changes both
 * the report language and the accessor result.
 */
final class Report extends BaseReport
{
    public function key(): string
    {
        return 'group_enrichment';
    }

    public function name(): string
    {
        return __('group_enrichment::report.name');
    }

    public function currency(): string
    {
        return 'CHF';
    }

    public function source(): ReportSource
    {
        return new EloquentSource(
            DemoOrder::query()->orderBy('category')->orderBy('ordered_at'),
            $this->fields(),
        );
    }

    public function define(ReportBuilder $r): void
    {
        $r->reportStart(view: 'report-start');
        $r->gridHeader(view: 'grid-head');
        $r->detail(view: 'row');
        $r->reportEnd(view: 'report-end');

        $r->group('category', function ($g): void {
            $g->header(view: 'category-head');
            $g->footer(view: 'category-foot');
            $g->enrichWith(CategoryInfo::class);
        });

        // Group scope on the report builder (equivalent to $g->aggSum(...)).
        $r->aggregate('category_total', Sum::class, field: 'amount', scope: 'group:1');
        $r->aggregate('grand_total', Sum::class, field: 'amount', scope: 'report');
    }

    /**
     * @return list<ReportField>
     */
    private function fields(): array
    {
        return [
            new ReportField('order_number', __('group_enrichment::report.columns.order'), filterable: false),
            new ReportField('customer', __('group_enrichment::report.columns.customer'), filterable: false),
            new ReportField('category', __('group_enrichment::report.columns.category'), type: 'enum', filterable: false),
            new ReportField('amount', __('group_enrichment::report.columns.amount'), type: 'number', filterable: false, aggregatable: true, format: 'currency'),
            new ReportField('ordered_at', __('group_enrichment::report.columns.ordered_at'), type: 'date', filterable: false, format: 'date'),
            new ReportField('status', __('group_enrichment::report.columns.status'), type: 'enum', filterable: false),
        ];
    }
}
