<?php

declare(strict_types=1);

use App\Support\DemoAssetPaths;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

it('renders static screenshots instead of live iframes on the landing page', function (): void {
    $response = $this->get('/');

    $response->assertOk()
        ->assertDontSee('<iframe', false);

    if (DemoAssetPaths::screenshotExists('price_list')) {
        $response->assertSee('images/examples/price_list.webp', false);
    } else {
        $response->assertSee('demo:screenshots', false);
    }
});

it('marks the example pages as noindex', function (): void {
    $this->get('/examples')
        ->assertOk()
        ->assertHeader('X-Robots-Tag', 'noindex, nofollow');

    $this->get('/examples/price_list')
        ->assertOk()
        ->assertHeader('X-Robots-Tag', 'noindex, nofollow');
});

it('marks the report pages as noindex', function (): void {
    $this->get('/reports/price-list/run')
        ->assertOk()
        ->assertHeader('X-Robots-Tag', 'noindex, nofollow');

    $this->get('/reports/internal/price_list')
        ->assertOk()
        ->assertHeader('X-Robots-Tag', 'noindex, nofollow');
});

it('serves the prebuilt pdf for the default report state', function (): void {
    $path = DemoAssetPaths::pdfPath('price_list', 'en');
    $backup = is_file($path) ? (string) file_get_contents($path) : null;

    if (! is_dir(dirname($path))) {
        mkdir(dirname($path), 0o775, true);
    }

    file_put_contents($path, "%PDF-1.4\n% demo fixture\n");

    try {
        $response = $this->get('/reports/price-list/pdf');

        $response->assertOk()
            ->assertHeader('content-type', 'application/pdf')
            ->assertHeader('X-Robots-Tag', 'noindex, nofollow');

        expect($response->baseResponse)
            ->toBeInstanceOf(BinaryFileResponse::class)
            ->and($response->baseResponse->getFile()->getPathname())
            ->toBe($path);

        $localized = $this->get('/reports/price-list/pdf?locale=de');

        $localized->assertOk()
            ->assertHeader('content-type', 'application/pdf');
    } finally {
        $backup === null ? @unlink($path) : file_put_contents($path, $backup);
    }
});

it('lists only the documentation in the sitemap', function (): void {
    $response = $this->get('/sitemap.xml');

    $response->assertOk()
        ->assertHeader('content-type', 'application/xml; charset=UTF-8')
        ->assertSee('<loc>', false)
        ->assertSee('/docs/getting-started', false)
        ->assertDontSee('/examples', false);
});

it('points robots.txt at the sitemap', function (): void {
    $response = $this->get('/robots.txt');

    $response->assertOk()
        ->assertHeader('content-type', 'text/plain; charset=UTF-8')
        ->assertSee('Disallow:', false)
        ->assertSee('/sitemap.xml', false);
});
