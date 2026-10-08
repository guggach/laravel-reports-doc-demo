<?php

declare(strict_types=1);

namespace App\Reports\Layout;

use Guggach\Reports\Definition\PageSetup;
use Guggach\Reports\Layouts\Layout;

final class CompanyLayout extends Layout
{
    public function view(): string
    {
        return 'reports.layouts.company';
    }

    public function pageSetup(): PageSetup
    {
        return PageSetup::a4()->portrait()->marginsMm(24, 18, 24, 18);
    }
}
