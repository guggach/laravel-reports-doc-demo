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
