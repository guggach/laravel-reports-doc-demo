<?php

declare(strict_types=1);

namespace App\Reports\PackingList;

use Guggach\Reports\Sources\ReportSource;

/**
 * Demo source for the packing list. Produces 60 positions so the strict
 * pagination has something to distribute across pages.
 */
final class Source extends ReportSource
{
    public function records(): iterable
    {
        $rows = [];

        for ($i = 1; $i <= 60; $i++) {
            $rows[] = [
                'pos' => $i,
                'article' => 'Artikel '.str_pad((string) $i, 3, '0', STR_PAD_LEFT),
                'qty' => ($i % 5) + 1,
            ];
        }

        return $rows;
    }
}
