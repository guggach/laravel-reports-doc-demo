<?php

declare(strict_types=1);

namespace App\Reports\PriceList;

use Guggach\Reports\Sources\ReportField;
use Guggach\Reports\Sources\ReportSource;

/**
 * Data source of the price list. Report-local on purpose (spec 7.1): a source
 * is never shared between reports. Filters are applied in memory here; a
 * database-backed variant would push them down instead.
 */
final class Source extends ReportSource
{
    public function records(): iterable
    {
        return $this->applyFilters([
            ['sku' => 'A-100', 'name' => 'Kaffeemaschine', 'category' => 'Küche', 'supplier' => 'Nordwind AG', 'price' => 129.00],
            ['sku' => 'B-200', 'name' => 'Wasserkocher', 'category' => 'Küche', 'supplier' => 'Nordwind AG', 'price' => 39.90],
            ['sku' => 'C-300', 'name' => 'Toaster', 'category' => 'Büro', 'supplier' => 'Berger GmbH', 'price' => 59.50],
            ['sku' => 'D-400', 'name' => 'Mixer', 'category' => 'Büro', 'supplier' => 'Conti AG', 'price' => 89.00],
        ]);
    }

    public function fields(): array
    {
        return [
            new ReportField('sku', 'SKU', type: 'string'),
            new ReportField('name', 'Bezeichnung', type: 'string'),
            new ReportField('category', 'Kategorie', type: 'enum', options: ['Küche', 'Büro']),
            new ReportField('supplier', 'Lieferant', type: 'relation', options: [
                'Nordwind AG', 'Berger GmbH', 'Conti AG', 'Delta Handels',
                'Egger & Co', 'Fuchs AG', 'Graf GmbH', 'Huber AG',
            ]),
            new ReportField('price', 'Preis', type: 'number'),
        ];
    }
}
