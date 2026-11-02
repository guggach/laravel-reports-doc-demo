<?php

declare(strict_types=1);

return [
    'name' => 'Mehrsprachige Preisliste',
    'title' => 'Preisliste',
    'intro' => 'Sprache und Formatierung folgen der Auswahl im Header. Die Währung bleibt unabhängig davon CHF.',
    'language_label' => 'Sprache',
    'format_label' => 'Format',
    'columns' => [
        'product' => 'Produkt',
        'category' => 'Kategorie',
        'valid_from' => 'Gültig ab',
        'status' => 'Status',
        'price' => 'Preis',
    ],
    'category' => [
        'rent' => 'Miete',
        'service' => 'Service',
        'sale' => 'Verkauf',
    ],
    'status' => [
        'active' => 'Aktiv',
        'draft' => 'Entwurf',
    ],
    'summary' => [
        'positions' => 'Positionen',
        'total' => 'Gesamttotal',
    ],
    'field' => [
        'product' => 'Produkt',
        'category' => 'Kategorie',
        'price' => 'Preis',
        'valid_from' => 'Gültig ab',
        'status' => 'Status',
    ],
];
