<?php

declare(strict_types=1);

namespace App\Reports\Multilanguage;

use Guggach\Reports\Sources\ReportField;
use Guggach\Reports\Sources\ReportSource;

/**
 * Language-neutral demo data. Labels, dates and numbers are rendered in the
 * language selected in the preview frame.
 */
final class Source extends ReportSource
{
    public function records(): iterable
    {
        return [
            ['product' => 'Studio Miete', 'category' => 'rent', 'price' => 2400.00, 'valid_from' => '2026-09-18', 'status' => 'active'],
            ['product' => 'Proberaum Service', 'category' => 'service', 'price' => 860.00, 'valid_from' => '2026-09-22', 'status' => 'active'],
            ['product' => 'Bühnenlicht Paket', 'category' => 'sale', 'price' => 12500.00, 'valid_from' => '2026-10-02', 'status' => 'active'],
            ['product' => 'Künstler-Workshop', 'category' => 'service', 'price' => 1450.00, 'valid_from' => '2026-10-05', 'status' => 'draft'],
            ['product' => 'Tanzboden Miete', 'category' => 'rent', 'price' => 1800.00, 'valid_from' => '2026-10-08', 'status' => 'active'],
            ['product' => 'Requisiten Verkauf', 'category' => 'sale', 'price' => 7600.00, 'valid_from' => '2026-10-12', 'status' => 'draft'],
        ];
    }

    /**
     * @return list<ReportField>
     */
    public function fields(): array
    {
        return [
            new ReportField('product', __('multilanguage::report.field.product'), filterable: false),
            new ReportField('category', __('multilanguage::report.field.category'), type: 'enum', filterable: false),
            new ReportField('price', __('multilanguage::report.field.price'), type: 'number', filterable: false, aggregatable: true, format: 'currency'),
            new ReportField('valid_from', __('multilanguage::report.field.valid_from'), type: 'date', filterable: false, format: 'date'),
            new ReportField('status', __('multilanguage::report.field.status'), type: 'enum', filterable: false),
        ];
    }
}
