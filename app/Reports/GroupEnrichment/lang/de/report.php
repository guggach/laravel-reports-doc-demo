<?php

declare(strict_types=1);

return [
    'name' => 'Gruppierter Umsatz mit Enrichment',
    'title' => 'Umsatz nach Kategorie',
    'intro' => 'Die Detailzeilen kommen aus demo_orders. Jeder Gruppenkopf lädt Kategoriename und Ziel über enrichWith() aus dem Eloquent-Model demo_categories.',
    'language_label' => 'Sprache',
    'columns' => [
        'order' => 'Auftrag',
        'customer' => 'Kunde',
        'category' => 'Kategorie',
        'amount' => 'Betrag',
        'ordered_at' => 'Bestellt am',
        'status' => 'Status',
    ],
    'summary' => [
        'subtotal' => 'Zwischensumme',
        'total' => 'Gesamttotal',
        'target' => 'Ziel',
    ],
    'status' => [
        'bezahlt' => 'Bezahlt',
        'offen' => 'Offen',
    ],
];
