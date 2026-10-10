<?php

declare(strict_types=1);

namespace App\Reports\PriceList;

use App\Reports\Layout\CompanyLayout;
use Guggach\Reports\Definition\ReportBuilder;
use Guggach\Reports\Report as BaseReport;
use Guggach\Reports\Sources\ArraySource;
use Guggach\Reports\Sources\ReportField;
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
        return new ArraySource(
            records: [
                ['sku' => 'A-100', 'name' => 'Kaffeemaschine', 'category' => 'Küche', 'price' => 129.00],
                ['sku' => 'B-200', 'name' => 'Wasserkocher', 'category' => 'Küche', 'price' => 39.90],
                ['sku' => 'C-300', 'name' => 'Toaster', 'category' => 'Büro', 'price' => 59.50],
                ['sku' => 'D-400', 'name' => 'Mixer', 'category' => 'Büro', 'price' => 89.00],
            ],
            fields: [
                new ReportField('sku', 'SKU', type: 'string'),
                new ReportField('name', 'Bezeichnung', type: 'string'),
                new ReportField('category', 'Kategorie', type: 'enum', options: ['Küche', 'Büro']),
                new ReportField('price', 'Preis', type: 'number'),
            ],
        );
    }

    public function define(ReportBuilder $r): void
    {
        $r->pageHeader(view: 'reports.price-list.header');
        $r->detail(view: 'reports.price-list.row');
        $r->pageFooter(view: 'reports.price-list.footer');

        // Grouped by category (data is sorted by category) with a subtotal.
        $r->group('category', function ($g): void {
            $g->header(view: 'reports.price-list.category-head');
            $g->footer(view: 'reports.price-list.category-foot');
            $g->aggSum('price', as: 'category_total');
        });
    }
}
