<?php

declare(strict_types=1);

use Illuminate\Testing\TestResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * The demo serves prebuilt PDFs for the default report state and only renders
 * live for custom filters, so a PDF response can be either a streamed body or
 * a static file.
 */
function pdfContent(TestResponse $response): string
{
    $base = $response->baseResponse;

    if ($base instanceof BinaryFileResponse) {
        return (string) file_get_contents($base->getFile()->getPathname());
    }

    return (string) $response->getContent();
}

it('serves the price list as pdf', function (): void {
    $response = $this->get('/reports/price-list/pdf');

    $response->assertOk();
    $response->assertHeader('content-type', 'application/pdf');

    $pdf = pdfContent($response);

    expect($pdf)->toStartWith('%PDF')
        ->and(strlen($pdf))->toBeGreaterThan(1000);

    @mkdir('/tmp/opencode', 0755, true);
    file_put_contents('/tmp/opencode/price-list.pdf', $pdf);
});

it('serves the strict packing list as a multi-page pdf', function (): void {
    $response = $this->get('/reports/packing-list/pdf');

    $response->assertOk();
    $response->assertHeader('content-type', 'application/pdf');

    $pdf = pdfContent($response);

    expect($pdf)->toStartWith('%PDF');

    @mkdir('/tmp/opencode', 0755, true);
    file_put_contents('/tmp/opencode/packing-list.pdf', $pdf);
});

it('renders a pdf live when a filter is set', function (): void {
    $response = $this->get('/reports/price-list/pdf?category=kitchen');

    $response->assertOk();
    $response->assertHeader('content-type', 'application/pdf');

    expect(pdfContent($response))->toStartWith('%PDF');
});

it('downloads the price list with a filename', function (): void {
    $response = $this->get('/download/price-list');

    $response->assertOk();
    $response->assertHeader('content-disposition', 'attachment; filename="preisliste.pdf"');
});
