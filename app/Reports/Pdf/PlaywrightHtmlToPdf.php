<?php

declare(strict_types=1);

namespace App\Reports\Pdf;

use Guggach\Reports\Contracts\HtmlToPdf;
use Guggach\Reports\Output\PdfOptions;
use RuntimeException;
use Symfony\Component\Process\Process;

/**
 * HTML -> PDF via the Playwright Chromium that is already installed for the
 * browser tests. In production an adapter around spatie/laravel-pdf or
 * Browsershot would be used instead.
 */
final class PlaywrightHtmlToPdf implements HtmlToPdf
{
    public function convert(string $html, PdfOptions $options): string
    {
        $process = new Process([
            config('reports.pdf.node_binary', 'node'),
            base_path('bin/html-to-pdf.mjs'),
            json_encode([
                'format' => $options->format,
                'landscape' => $options->landscape,
                'printBackground' => $options->printBackground,
                'margins' => $options->margins,
            ], JSON_THROW_ON_ERROR),
        ]);

        $process->setInput($html);
        $process->setTimeout(120);
        $process->run();

        if (! $process->isSuccessful()) {
            throw new RuntimeException(
                'HTML to PDF conversion failed: '.$process->getErrorOutput()
            );
        }

        return $process->getOutput();
    }
}
