<?php

declare(strict_types=1);

namespace App\View\Components\Ui;

use Illuminate\View\Component;
use Illuminate\View\View;

final class Preview extends Component
{
    public function __construct(
        public string $src,
        public ?string $title = null,
        public ?string $pdf = null,
        public ?string $open = null,
        public string $height = '34rem',
    ) {}

    public function render(): View
    {
        return view('components.ui.preview');
    }
}
