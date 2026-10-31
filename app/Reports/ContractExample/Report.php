<?php

declare(strict_types=1);

namespace App\Reports\ContractExample;

use Guggach\Reports\Definition\PageSetup;
use Guggach\Reports\Definition\ReportBuilder;
use Guggach\Reports\Definition\ReportMode;
use Guggach\Reports\Report as BaseReport;
use Guggach\Reports\Sources\ReportSource;

/**
 * Free-form Flow demo: a car purchase contract with the general terms starting
 * on page 2 via a CSS page break. Unlike the invoice example this report does
 * not use fixed page blocks; Chromium paginates the prose.
 */
final class Report extends BaseReport
{
    public function key(): string
    {
        return 'contract_example';
    }

    public function name(): string
    {
        return 'Autokaufvertrag (Beispiel)';
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
        $r->mode(ReportMode::Flow);
        $r->pageSetup(PageSetup::a4()->portrait()->marginsMm(24, 20, 24, 20));

        // One complete contract per record; the browser paginates the prose.
        $r->freeform(view: 'contract');
    }
}
