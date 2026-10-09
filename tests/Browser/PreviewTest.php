<?php

declare(strict_types=1);

it('shows the report in the A4 preview frame', function (): void {
    $page = visit('/report/price-list/preview');

    $page->assertSee('Preisliste 2026')
        ->assertSee('Drucken');

    $page->screenshot(filename: 'preview-frame');
});
