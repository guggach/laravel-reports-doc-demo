<?php

declare(strict_types=1);

it('shows the filter form before running the report', function (): void {
    $this->get('/reports/price-list')
        ->assertOk()
        ->assertSee('Kategorie')
        ->assertSee('Bezeichnung')
        ->assertSee('Weiter');
});

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

it('filters the internal price list by a numeric range', function (): void {
    $response = $this->get('/reports/internal/price-list?price[operator]=between&price[value][]=50&price[value][]=100');

    $content = (string) $response->getContent();

    expect($content)->toContain('Toaster')
        ->toContain('Mixer')
        ->not->toContain('Kaffeemaschine');
});

it('filters the internal price list by a relation in-list', function (): void {
    $response = $this->get('/reports/internal/price-list?supplier[]=Nordwind%20AG');

    $content = (string) $response->getContent();

    expect($content)->toContain('Kaffeemaschine')
        ->toContain('Wasserkocher')
        ->not->toContain('Toaster');
});
