<?php

declare(strict_types=1);

it('shows the report in the A4 preview frame', function (): void {
    $page = visit('/reports/price-list');

    $page->assertSee('Preisliste')
        ->assertSee('Drucken')
        ->assertSee('PDF');

    $page->screenshot(filename: 'preview-frame');
});
