<?php

declare(strict_types=1);

namespace App\View\Components\Ui;

use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * Static screenshot of a report, used on the landing page instead of a live
 * iframe: the first page stays fast, crawlable and independent of Chromium.
 */
final class Screenshot extends Component
{
    public function __construct(
        public string $src,
        public string $href,
        public ?string $title = null,
        public ?string $pdf = null,
        public string $height = '30rem',
    ) {}

    public function exists(): bool
    {
        return is_file(public_path($this->src));
    }

    public function render(): View
    {
        return view('components.ui.screenshot');
    }
}
