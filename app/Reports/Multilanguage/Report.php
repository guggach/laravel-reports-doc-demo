<?php

declare(strict_types=1);

namespace App\Reports\Multilanguage;

use Guggach\Reports\Aggregates\Count;
use Guggach\Reports\Aggregates\Sum;
use Guggach\Reports\Definition\ReportBuilder;
use Guggach\Reports\Report as BaseReport;
use Guggach\Reports\Sources\ReportSource;

/**
 * Flow report with module translations and locale-aware dates/numbers.
 * The language selector in the preview frame changes the run locale; this
 * report then renders all labels, dates and amounts in that language.
 */
final class Report extends BaseReport
{
    public function key(): string
    {
        return 'multilanguage';
    }

    public function name(): string
    {
        return __('multilanguage::report.name');
    }

    public function layout(): string
    {
        return 'default';
    }

    public function currency(): string
    {
        return 'CHF';
    }

    public function source(): ReportSource
    {
        return new Source;
    }

    public function define(ReportBuilder $r): void
    {
        $r->reportStart(view: 'report-start');
        $r->gridHeader(view: 'grid-head');
        $r->detail(view: 'row');
        $r->reportEnd(view: 'report-end');

        $r->aggregate('total', Sum::class, field: 'price', scope: 'report');
        $r->aggregate('positions', Count::class, field: 'product', scope: 'report');
    }
}
