<?php

declare(strict_types=1);

namespace App\Reports\PriceList;

use App\Reports\Layout\CompanyLayout;
use Guggach\Reports\Definition\ReportBuilder;
use Guggach\Reports\Filters\FilterBuilder;
use Guggach\Reports\Report as BaseReport;
use Guggach\Reports\Sources\ReportSource;

final class Report extends BaseReport
{
    public function key(): string
    {
        return 'price_list';
    }

    public function name(): string
    {
        return 'Preisliste';
    }

    public function layout(): string
    {
        return CompanyLayout::class;
    }

    public function source(): ReportSource
    {
        return new Source;
    }

    /**
     * Demonstrate the fluent control description: operator listbox for the
     * number, multiselect for the enum and a searchable dual-list for the
     * relation (id/FK) field.
     */
    public function filterControls(): array
    {
        return FilterBuilder::for($this->source())
            ->field('price')->operators(['=', '>=', '<=', 'between', 'in'])
            ->field('category')->multiselect()
            ->field('supplier')->picker(valueField: 'id', labelField: 'label')
            ->build();
    }

    public function define(ReportBuilder $r): void
    {
        // Module-relative view names resolve to app/Reports/PriceList/views/*.
        // Report start/end run once per report; the grid header introduces the
        // table and the detail band renders one row per record.
        $r->reportStart(view: 'report-start');
        $r->gridHeader(view: 'grid-head');
        $r->detail(view: 'row');
        $r->reportEnd(view: 'report-end');

        // Grouped by category (data is sorted by category) with a subtotal.
        $r->group('category', function ($g): void {
            $g->header(view: 'category-head');
            $g->footer(view: 'category-foot');
            $g->aggSum('price', as: 'category_total');
        });
    }
}
