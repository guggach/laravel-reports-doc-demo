<?php

declare(strict_types=1);

namespace App\Reports\GroupEnrichment;

use App\Models\DemoCategory;
use Guggach\Reports\Sources\EloquentSource;
use Guggach\Reports\Sources\ReportField;
use Guggach\Reports\Sources\ReportSource;

/**
 * Enrichment source: one Eloquent query per group. The engine passes the group
 * key as a filter (category = …), so the model's translated name accessor
 * runs in the active report locale.
 */
final class CategoryInfo extends ReportSource
{
    public function records(): iterable
    {
        return (new EloquentSource(
            DemoCategory::class,
            [
                // "enum" makes the group key an exact match (operator "in").
                new ReportField('category', 'Kategorie', type: 'enum'),
            ],
        ))
            ->withFilters($this->filters() ?? [])
            ->withLocale($this->locale())
            ->records();
    }
}
