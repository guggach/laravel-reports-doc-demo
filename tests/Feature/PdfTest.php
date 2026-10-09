<?php

declare(strict_types=1);

it('serves the price list as pdf', function (): void {
    $response = $this->get('/report/price-list.pdf');

    $response->assertOk();
    $response->assertHeader('content-type', 'application/pdf');

    $pdf = (string) $response->getContent();

    expect($pdf)->toStartWith('%PDF')
        ->and(strlen($pdf))->toBeGreaterThan(1000);

    @mkdir('/tmp/opencode', 0755, true);
    file_put_contents('/tmp/opencode/price-list.pdf', $pdf);
});

it('serves the strict packing list as a multi-page pdf', function (): void {
    $response = $this->get('/report/packing-list.pdf');

    $response->assertOk();
    $response->assertHeader('content-type', 'application/pdf');

    $pdf = (string) $response->getContent();

    expect($pdf)->toStartWith('%PDF');

    @mkdir('/tmp/opencode', 0755, true);
    file_put_contents('/tmp/opencode/packing-list.pdf', $pdf);
});
