<?php

declare(strict_types=1);

namespace App\Reports\LabelSheet;

use Guggach\Reports\Definition\PageSetup;
use Guggach\Reports\Definition\ReportBuilder;
use Guggach\Reports\Definition\ReportMode;
use Guggach\Reports\Report as BaseReport;
use Guggach\Reports\Sources\ReportSource;

/**
 * N-up demo: one full-width detail band split into four label cells per row
 * (docs/spec.md 6.7). Strict mode makes the row the pagination unit.
 */
final class Report extends BaseReport
{
    public function key(): string
    {
        return 'label_sheet';
    }

    public function name(): string
    {
        return 'Versandetiketten';
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
        $r->pageSetup(PageSetup::a4()->portrait()->marginsMm(16, 12, 16, 12));

        $r->pageHeader(view: 'header')->height(14);
        $r->pageFooter(view: 'footer')->height(8);

        // One row holds four labels; height is the height of the whole row.
        // A row occupies 32 mm + 2 mm row gap = 34 mm; 7 rows (238 mm) fit
        // into the 243 mm body of an A4 page => 28 labels.
        $r->detail(view: 'label', height: 32)
            ->columns(4, gap: 3, rowGap: 2);
    }
}
