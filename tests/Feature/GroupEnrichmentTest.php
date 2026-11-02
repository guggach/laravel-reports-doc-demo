<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('renders translated group data from the Eloquent enrichment source', function (): void {
    $this->get('/reports/internal/group_enrichment?locale=en')
        ->assertOk()
        ->assertSee('Revenue by category')
        ->assertSee('Rent')
        ->assertSee('Sale')
        ->assertSee('15,000.00')
        ->assertSee('Grand total')
        ->assertDontSee('Verkauf');
});

it('renders the German group data and number format', function (): void {
    $this->get('/reports/internal/group_enrichment?locale=de')
        ->assertOk()
        ->assertSee('Umsatz nach Kategorie')
        ->assertSee('Miete')
        ->assertSee('Verkauf')
        ->assertSee('15&#039;000.00', false)
        ->assertSee('Gesamttotal')
        ->assertDontSee('Sale');
});
