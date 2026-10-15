<?php

declare(strict_types=1);

it('shows the report in the preview frame with a paper sheet', function (): void {
    $page = visit('/reports/price-list/run');

    $page->assertSee('Preisliste')
        ->assertSee('Drucken')
        ->assertSee('PDF');

    $page->screenshot(filename: 'preview-frame');
});

it('zooms the preview in and out', function (): void {
    $page = visit('/reports/price-list/run');

    $page->click('[data-zoom-in]')
        ->assertSee('110%')
        ->click('[data-zoom-out]')
        ->click('[data-zoom-out]')
        ->assertSee('90%');
});
