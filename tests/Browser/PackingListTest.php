<?php

declare(strict_types=1);

it('renders the strict packing list as fixed A4 pages', function (): void {
    $page = visit('/reports/internal/packing-list');

    $page->assertSee('Lieferschein')
        ->assertSee('Seite 1 / 3')
        ->assertSee('Seite 3 / 3')
        ->assertSee('Artikel 060');

    $page->screenshot(filename: 'packing-list-strict', fullPage: true);
});

it('shows the strict report in the preview without a second paper sheet', function (): void {
    $page = visit('/reports/packing-list');

    $page->assertSee('Lieferschein')
        ->assertSee('Drucken');

    $page->screenshot(filename: 'packing-list-preview', fullPage: true);
});
