<?php

declare(strict_types=1);

it('filters the internal price list by category', function (): void {
    $response = $this->get('/reports/internal/price-list?category=K%C3%BCche');

    $response->assertOk();

    $content = (string) $response->getContent();

    expect($content)->toContain('Kaffeemaschine')
        ->toContain('Wasserkocher')
        ->not->toContain('Toaster')
        ->not->toContain('Mixer');
});

it('filters the internal price list by price', function (): void {
    $response = $this->get('/reports/internal/price-list?price=129');

    $content = (string) $response->getContent();

    expect($content)->toContain('Kaffeemaschine')
        ->not->toContain('Wasserkocher');
});
