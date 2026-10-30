<?php

declare(strict_types=1);

namespace App\Reports\PackingList;

use Guggach\Reports\Definition\PageSetup;
use Guggach\Reports\Definition\ReportBuilder;
use Guggach\Reports\Definition\ReportMode;
use Guggach\Reports\Report as BaseReport;
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
        return new Source;
    }

    public function define(ReportBuilder $r): void
    {
        $r->mode(ReportMode::Strict);
        $r->pageSetup(PageSetup::a4()->portrait()->marginsMm(20, 15, 20, 15));

        // Module-relative view names resolve to app/Reports/PackingList/views/*.
        $r->pageHeader(view: 'header')->height(20);
        $r->gridHeader(view: 'grid-head')->height(8);
        $r->detail(view: 'row', height: 8);
        $r->pageFooter(view: 'footer')->height(10);
    }
}
