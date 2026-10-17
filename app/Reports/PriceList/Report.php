<?php

declare(strict_types=1);

namespace App\Reports\PriceList;

use App\Reports\Layout\CompanyLayout;
use Guggach\Reports\Definition\ReportBuilder;
use Guggach\Reports\Filters\FilterBuilder;
use Guggach\Reports\Report as BaseReport;
use Guggach\Reports\Sources\ArraySource;
use Guggach\Reports\Sources\ReportField;
use Guggach\Reports\Sources\ReportSource;

final class Report extends BaseReport
{
    public function key(): string
    {
        return 'price_list';
    }

    public function name(): string
    {
        return 'Preisliste';
    }

    public function layout(): string
    {
        return CompanyLayout::class;
    }

    public function source(): ReportSource
    {
        return new ArraySource(
            records: [
                ['sku' => 'A-100', 'name' => 'Kaffeemaschine', 'category' => 'Küche', 'supplier' => 'Acme AG', 'price' => 129.00],
                ['sku' => 'B-200', 'name' => 'Wasserkocher', 'category' => 'Küche', 'supplier' => 'Acme AG', 'price' => 39.90],
                ['sku' => 'C-300', 'name' => 'Toaster', 'category' => 'Büro', 'supplier' => 'Berger GmbH', 'price' => 59.50],
                ['sku' => 'D-400', 'name' => 'Mixer', 'category' => 'Büro', 'supplier' => 'Conti AG', 'price' => 89.00],
            ],
            fields: [
                new ReportField('sku', 'SKU', type: 'string'),
                new ReportField('name', 'Bezeichnung', type: 'string'),
                new ReportField('category', 'Kategorie', type: 'enum', options: ['Küche', 'Büro']),
                new ReportField('supplier', 'Lieferant', type: 'relation', options: [
                    'Acme AG', 'Berger GmbH', 'Conti AG', 'Delta Handels',
                    'Egger & Co', 'Fuchs AG', 'Graf GmbH', 'Huber AG',
                ]),
                new ReportField('price', 'Preis', type: 'number'),
            ],
        );
    }

    /**
     * Demonstrate the fluent control description: operator listbox for the
     * number, multiselect for the enum and a searchable dual-list for the
     * relation (id/FK) field.
     */
    public function filterControls(): array
    {
        return FilterBuilder::for($this->source())
            ->field('price')->operators(['=', '>=', '<=', 'between', 'in'])
            ->field('category')->multiselect()
            ->field('supplier')->picker(valueField: 'id', labelField: 'label')
            ->build();
    }

    public function define(ReportBuilder $r): void
    {
        // Module-relative view names resolve to app/Reports/PriceList/views/*.
        $r->pageHeader(view: 'header');
        $r->detail(view: 'row');
        $r->pageFooter(view: 'footer');

        // Grouped by category (data is sorted by category) with a subtotal.
        $r->group('category', function ($g): void {
            $g->header(view: 'category-head');
            $g->footer(view: 'category-foot');
            $g->aggSum('price', as: 'category_total');
        });
    }
}
