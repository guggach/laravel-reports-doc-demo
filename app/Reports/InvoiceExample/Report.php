<?php

declare(strict_types=1);

namespace App\Reports\InvoiceExample;

use Guggach\Reports\Definition\PageSetup;
use Guggach\Reports\Definition\ReportBuilder;
use Guggach\Reports\Definition\ReportMode;
use Guggach\Reports\Report as BaseReport;
use Guggach\Reports\Sources\ReportSource;

/**
 * Free-form demo: a complete invoice in one detail view. The payment slip is a
 * page block; it stays on page 1 when it fits and moves to page 2 otherwise.
 */
final class Report extends BaseReport
{
    public function key(): string
    {
        return 'invoice_example';
    }

    public function name(): string
    {
        return 'Rechnung (Beispiel)';
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
        $r->pageSetup(PageSetup::a4()->portrait()->marginsMm(18, 16, 18, 16));
        $r->pageNumbering('perForm');

        // One complete invoice per detail record. The page blocks in
        // views/invoice.blade.php declare their heights (spec 6.8).
        $r->freeform(view: 'invoice');

        // On page 1 the invoice starts with the brand/address block; the page
        // header with the invoice number is only needed from page 2 onwards.
        $r->pageHeader(view: 'header')->height(22)->hideOnFirstPage();
        $r->pageFooter(view: 'footer')->height(10);
    }
}
