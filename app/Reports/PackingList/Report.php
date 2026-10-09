<?php

declare(strict_types=1);

namespace App\Reports\PackingList;

use Guggach\Reports\Definition\PageSetup;
use Guggach\Reports\Definition\ReportBuilder;
use Guggach\Reports\Definition\ReportMode;
use Guggach\Reports\Report as BaseReport;
use Guggach\Reports\Sources\ArraySource;
use Guggach\Reports\Sources\ReportSource;

final class Report extends BaseReport
{
    public function key(): string
    {
        return 'packing_list';
    }

    public function name(): string
    {
        return 'Lieferschein';
    }

    public function layout(): string
    {
        return 'default';
    }

    public function source(): ReportSource
    {
        $rows = [];

        for ($i = 1; $i <= 60; $i++) {
            $rows[] = [
                'pos' => $i,
                'article' => 'Artikel '.str_pad((string) $i, 3, '0', STR_PAD_LEFT),
                'qty' => ($i % 5) + 1,
            ];
        }

        return new ArraySource($rows);
    }

    public function define(ReportBuilder $r): void
    {
        $r->mode(ReportMode::Strict);
        $r->pageSetup(PageSetup::a4()->portrait()->marginsMm(20, 15, 20, 15));

        $r->pageHeader(view: 'reports.packing-list.header')->height(20);
        $r->gridHeader(view: 'reports.packing-list.grid-head')->height(8);
        $r->detail(view: 'reports.packing-list.row', height: 8);
        $r->pageFooter(view: 'reports.packing-list.footer')->height(10);
    }
}
