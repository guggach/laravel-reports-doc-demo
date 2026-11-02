<?php

declare(strict_types=1);

namespace App\Reports\Multilanguage;

use Guggach\Reports\Localization\ReportLocale;
use Guggach\Reports\Sources\ReportField;
use Guggach\Reports\Sources\ReportSource;

/**
 * Language-neutral demo data. In a real application product, category and
 * status would come from Eloquent models with spatie/laravel-translatable;
 * the reports engine sets app()->getLocale() before the source is queried.
 * This fixture demonstrates the same idea with language arrays.
 */
final class Source extends ReportSource
{
    public function records(): iterable
    {
        $language = $this->language();

        $records = [
            [
                'product' => ['de' => 'Studio Miete', 'en' => 'Studio rent'],
                'category' => ['de' => 'Miete', 'en' => 'Rent'],
                'price' => 2400.00,
                'valid_from' => '2026-09-18',
                'status' => ['de' => 'Aktiv', 'en' => 'Active'],
                'status_key' => 'active',
            ],
            [
                'product' => ['de' => 'Proberaum Service', 'en' => 'Rehearsal room service'],
                'category' => ['de' => 'Service', 'en' => 'Service'],
                'price' => 860.00,
                'valid_from' => '2026-09-22',
                'status' => ['de' => 'Aktiv', 'en' => 'Active'],
                'status_key' => 'active',
            ],
            [
                'product' => ['de' => 'Bühnenlicht Paket', 'en' => 'Stage lighting package'],
                'category' => ['de' => 'Verkauf', 'en' => 'Sale'],
                'price' => 12500.00,
                'valid_from' => '2026-10-02',
                'status' => ['de' => 'Aktiv', 'en' => 'Active'],
                'status_key' => 'active',
            ],
            [
                'product' => ['de' => 'Künstler-Workshop', 'en' => 'Artist workshop'],
                'category' => ['de' => 'Service', 'en' => 'Service'],
                'price' => 1450.00,
                'valid_from' => '2026-10-05',
                'status' => ['de' => 'Entwurf', 'en' => 'Draft'],
                'status_key' => 'draft',
            ],
            [
                'product' => ['de' => 'Tanzboden Miete', 'en' => 'Dance floor rent'],
                'category' => ['de' => 'Miete', 'en' => 'Rent'],
                'price' => 1800.00,
                'valid_from' => '2026-10-08',
                'status' => ['de' => 'Aktiv', 'en' => 'Active'],
                'status_key' => 'active',
            ],
            [
                'product' => ['de' => 'Requisiten Verkauf', 'en' => 'Props sale'],
                'category' => ['de' => 'Verkauf', 'en' => 'Sale'],
                'price' => 7600.00,
                'valid_from' => '2026-10-12',
                'status' => ['de' => 'Entwurf', 'en' => 'Draft'],
                'status_key' => 'draft',
            ],
        ];

        return array_map(function (array $record) use ($language): array {
            foreach (['product', 'category', 'status'] as $key) {
                $record[$key] = $this->translated($record[$key], $language);
            }

            return $record;
        }, $records);
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

    private function language(): string
    {
        $locale = $this->locale() ?? app()->getLocale();

        return explode('_', ReportLocale::normalize($locale))[0];
    }

    /**
     * @param  array<string, string>  $values
     */
    private function translated(array $values, string $language): string
    {
        $value = $values[$language] ?? $values['en'] ?? reset($values);

        return is_string($value) ? $value : '';
    }
}
