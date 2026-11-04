<?php

declare(strict_types=1);

return [

    'name' => 'Auftragsliste (Excel-Export)',
    'intro' => 'Dieselbe Quelle speist die PDF-Vorschau und den flachen Excel-Export. Die XLSX-Datei behält Beträge und Daten als echte Zellwerte und ergänzt eine Totalzeile.',
    'total' => 'Total',

    'columns' => [
        'order' => 'Auftrag',
        'customer' => 'Kunde',
        'category' => 'Kategorie',
        'amount' => 'Betrag',
        'ordered_at' => 'Bestellt am',
        'status' => 'Status',
    ],

    'categories' => [
        'rent' => 'Miete',
        'service' => 'Service',
        'sale' => 'Verkauf',
    ],

    'status' => [
        'open' => 'Offen',
        'paid' => 'Bezahlt',
    ],

];
