<?php

declare(strict_types=1);

it('shows the filter form and applies the filter in the preview', function (): void {
    $page = visit('/reports/price-list?category=K%C3%BCche');

    $page->assertSee('Kategorie')
        ->assertSee('Bezeichnung')
        ->assertSee('Filtern');

    $page->screenshot(filename: 'preview-filtered');
});
