<?php

declare(strict_types=1);

namespace App\Support;

/**
 * Locates the Chromium binary used for PDF output and the generated demo
 * screenshots. The explicit env var always wins; otherwise the Playwright
 * installation that `npx playwright install chromium` creates is used.
 */
final class ChromiumBinary
{
    public static function path(): ?string
    {
        $binary = env('LARAVEL_PDF_CHROME_BINARY');

        if (is_string($binary) && $binary !== '') {
            return $binary;
        }

        $home = getenv('HOME');

        if ($home === false || $home === '') {
            return null;
        }

        $matches = glob($home.'/.cache/ms-playwright/chromium-*/chrome-linux64/chrome') ?: [];
        rsort($matches);

        return $matches[0] ?? null;
    }
}
