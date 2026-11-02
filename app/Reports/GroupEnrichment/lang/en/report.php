<?php

declare(strict_types=1);

return [
    'name' => 'Grouped revenue with enrichment',
    'title' => 'Revenue by category',
    'intro' => 'The detail rows come from demo_orders. Every group header loads its translated category name and target through enrichWith() from the demo_categories Eloquent model.',
    'language_label' => 'Language',
    'columns' => [
        'order' => 'Order',
        'customer' => 'Customer',
        'category' => 'Category',
        'amount' => 'Amount',
        'ordered_at' => 'Ordered on',
        'status' => 'Status',
    ],
    'summary' => [
        'subtotal' => 'Subtotal',
        'total' => 'Grand total',
        'target' => 'Target',
    ],
    'status' => [
        'bezahlt' => 'Paid',
        'offen' => 'Open',
    ],
];
