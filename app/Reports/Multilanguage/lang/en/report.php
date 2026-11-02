<?php

declare(strict_types=1);

return [
    'name' => 'Multilingual price list',
    'title' => 'Price list',
    'intro' => 'Language and formatting follow the selection in the header. The currency stays CHF independently of the locale.',
    'language_label' => 'Language',
    'format_label' => 'Format',
    'columns' => [
        'product' => 'Product',
        'category' => 'Category',
        'valid_from' => 'Valid from',
        'status' => 'Status',
        'price' => 'Price',
    ],
    'category' => [
        'rent' => 'Rent',
        'service' => 'Service',
        'sale' => 'Sale',
    ],
    'status' => [
        'active' => 'Active',
        'draft' => 'Draft',
    ],
    'summary' => [
        'positions' => 'Positions',
        'total' => 'Total',
    ],
    'field' => [
        'product' => 'Product',
        'category' => 'Category',
        'price' => 'Price',
        'valid_from' => 'Valid from',
        'status' => 'Status',
    ],
];
