<?php

declare(strict_types=1);

namespace App\View\Components\Ui;

use App\Support\CodeSample;
use Illuminate\View\Component;
use Illuminate\View\View;

final class Code extends Component
{
    /**
     * @var list<array{label: string, path: string, lang: string, code: string, html: string}>
     */
    public array $tabs;

    /**
     * @param  list<string|array{path?: string, code?: string, label?: string, lang?: string}>  $tabs
     */
    public function __construct(
        CodeSample $samples,
        array $tabs = [],
        public ?string $caption = null,
    ) {
        $resolved = [];

        foreach ($tabs as $tab) {
            if (is_string($tab)) {
                $resolved[] = $samples->tab($tab);

                continue;
            }

            if (isset($tab['code'])) {
                $resolved[] = $samples->snippet(
                    $tab['code'],
                    $tab['lang'] ?? 'php',
                    $tab['label'] ?? 'snippet',
                    $tab['path'] ?? '',
                );

                continue;
            }

            $resolved[] = $samples->tab(
                (string) ($tab['path'] ?? ''),
                $tab['label'] ?? null,
                $tab['lang'] ?? null,
            );
        }

        $this->tabs = $resolved;
    }

    public function render(): View
    {
        return view('components.ui.code');
    }
}
