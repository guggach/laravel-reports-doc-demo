<?php

declare(strict_types=1);

namespace App\Reports\InvoiceExample;

use Guggach\Reports\Sources\ReportSource;

/**
 * Two demo invoices.
 *
 * Invoice 1 has two positions, so the payment slip still fits on page 1.
 * Invoice 2 has eight positions, which pushes the payment slip to page 2.
 */
final class Source extends ReportSource
{
    public function records(): iterable
    {
        return [
            [
                'invoice_number' => 'R-265040063001',
                'invoice_date' => '18.09.2026',
                'customer' => 'Example GmbH',
                'address' => ['Pfingstweidstrasse 1', '8031 Zürich'],
                'vat_number' => 'CHE-106.833.447 MWST',
                'due' => 'Fällig bei Erhalt der Rechnung netto',
                'positions' => [
                    [
                        'description' => 'Miete Apartment Kategorie City / Gast Peter Müller',
                        'period' => '01.11.2026 – 21.11.2026',
                        'quantity' => '20 Nächte',
                        'unit_price' => 106.67,
                        'total' => 2133.35,
                        'vat' => 3.8,
                    ],
                    [
                        'description' => 'Service und Reinigung',
                        'period' => '01.11.2026 – 21.11.2026',
                        'quantity' => '20 Nächte',
                        'unit_price' => 13.33,
                        'total' => 266.65,
                        'vat' => 3.8,
                    ],
                ],
                'invoice_total' => 2400.00,
                'invoice_vat_total' => 87.85,
            ],
            [
                'invoice_number' => 'R-265040063002',
                'invoice_date' => '18.09.2026',
                'customer' => 'Alpine Studio GmbH',
                'address' => ['Seefeldstrasse 999', '8008 Zürich'],
                'vat_number' => 'CHE-106.833.447 MWST',
                'due' => 'Fällig bei Erhalt der Rechnung netto',
                'positions' => [
                    ['description' => 'Miete Apartment Kategorie Studio', 'period' => '01.12.2026 – 21.12.2026', 'quantity' => '20 Nächte', 'unit_price' => 120.00, 'total' => 2400.00, 'vat' => 3.8],
                    ['description' => 'Service und Reinigung', 'period' => '01.12.2026 – 21.12.2026', 'quantity' => '20 Nächte', 'unit_price' => 15.00, 'total' => 300.00, 'vat' => 3.8],
                    ['description' => 'Zusätzliche Bettwäsche', 'period' => '01.12.2026', 'quantity' => '2 Sets', 'unit_price' => 25.00, 'total' => 50.00, 'vat' => 3.8],
                    ['description' => 'Parkplatz', 'period' => '01.12.2026 – 21.12.2026', 'quantity' => '20 Tage', 'unit_price' => 12.00, 'total' => 240.00, 'vat' => 3.8],
                    ['description' => 'Endreinigung', 'period' => '21.12.2026', 'quantity' => '1', 'unit_price' => 90.00, 'total' => 90.00, 'vat' => 3.8],
                    ['description' => 'Kurtaxe', 'period' => '01.12.2026 – 21.12.2026', 'quantity' => '40', 'unit_price' => 3.50, 'total' => 140.00, 'vat' => 3.8],
                    ['description' => 'Frühstückskorb', 'period' => '01.12.2026', 'quantity' => '1', 'unit_price' => 45.00, 'total' => 45.00, 'vat' => 3.8],
                    ['description' => 'Late Check-out', 'period' => '21.12.2026', 'quantity' => '1', 'unit_price' => 35.00, 'total' => 35.00, 'vat' => 3.8],
                ],
                'invoice_total' => 3300.00,
                'invoice_vat_total' => 120.81,
            ],
        ];
    }
}
