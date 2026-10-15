<?php

declare(strict_types=1);

it('shows the complete filter form before running the report', function (): void {
    $page = visit('/reports/price-list');

    $page->assertSee('Kategorie')
        ->assertSee('Bezeichnung')
        ->assertSee('Lieferant')
        ->assertSee('Weiter');

    $page->screenshot(filename: 'filter-form');
});

it('renders the filtered report in the preview frame', function (): void {
    $page = visit('/reports/price-list/run?category=K%C3%BCche');

    $page->assertSee('Preisliste')
        ->assertSee('Filter ändern')
        ->assertSee('Drucken');

    $page->screenshot(filename: 'preview-filtered');
});

it('selects values through the dual-list picker', function (): void {
    $page = visit('/reports/price-list');

    $page->click('[data-picker-open]')
        ->assertSee('Acme AG');

    $page->screenshot(filename: 'filter-picker-dialog');

    $page->click('[data-picker-move="all-right"]')
        ->click('[data-picker-ok]')
        ->assertSee('Auswahl (8)');
});
