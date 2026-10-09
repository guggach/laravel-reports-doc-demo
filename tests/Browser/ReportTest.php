<?php

declare(strict_types=1);

it('renders the grouped price list report', function (): void {
    $page = visit('/reports/internal/price-list');

    $page->assertSee('Guggach AG')
        ->assertSee('Preisliste')
        ->assertSee('Küche')
        ->assertSee('Büro')
        ->assertSee('Summe Küche')
        ->assertSee('Kaffeemaschine')
        ->assertSee('4 Positionen');

    $page->screenshot(filename: 'price-list-grouped');
});
