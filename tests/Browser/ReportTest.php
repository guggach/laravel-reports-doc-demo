<?php

declare(strict_types=1);

it('renders the price list report inside the company layout', function (): void {
    $page = visit('/report/price-list');

    $page->assertSee('Guggach AG')
        ->assertSee('Preisliste')
        ->assertSee('Kaffeemaschine')
        ->assertSee('Wasserkocher')
        ->assertSee('4 Positionen');

    $page->screenshot(filename: 'price-list-layout');
});
