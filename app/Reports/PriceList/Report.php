<?php

declare(strict_types=1);

namespace App\Reports\PriceList;

use Guggach\Reports\Definition\ReportBuilder;
use Guggach\Reports\Report as BaseReport;
use Guggach\Reports\Sources\ArraySource;
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

    public function source(): ReportSource
    {
        return new ArraySource([
            ['sku' => 'A-100', 'name' => 'Kaffeemaschine', 'price' => 129.00],
            ['sku' => 'B-200', 'name' => 'Wasserkocher', 'price' => 39.90],
            ['sku' => 'C-300', 'name' => 'Toaster', 'price' => 59.50],
            ['sku' => 'D-400', 'name' => 'Mixer', 'price' => 89.00],
        ]);
    }

    public function define(ReportBuilder $r): void
    {
        $r->pageHeader(view: 'reports.price-list.header');
        $r->detail(view: 'reports.price-list.row');
        $r->pageFooter(view: 'reports.price-list.footer');
    }
}
