<?php

declare(strict_types=1);

return [

    'name' => 'Order list (Excel export)',
    'intro' => 'The same source feeds the PDF preview and the flat Excel export. The XLSX keeps amounts and dates as real cell values and adds a total row.',
    'total' => 'Total',

    'columns' => [
        'order' => 'Order',
        'customer' => 'Customer',
        'category' => 'Category',
        'amount' => 'Amount',
        'ordered_at' => 'Ordered at',
        'status' => 'Status',
    ],

    'categories' => [
        'rent' => 'Rent',
        'service' => 'Service',
        'sale' => 'Sale',
    ],

    'status' => [
        'open' => 'Open',
        'paid' => 'Paid',
    ],

];
