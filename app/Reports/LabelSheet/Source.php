<?php

declare(strict_types=1);

namespace App\Reports\LabelSheet;

use Guggach\Reports\Sources\ReportSource;

/**
 * Demo labels. 30 records at 4 per row = 7 full rows + 1 row with 2 labels
 * (and 2 padded cells); with 7 rows per page the report spans two pages
 * (28 + 2 labels).
 */
final class Source extends ReportSource
{
    public function records(): iterable
    {
        $people = [
            ['Müller', 'Anna', 'Bahnhofstrasse 12', '8001', 'Zürich', 'CH'],
            ['Meier', 'Beat', 'Dorfplatz 4', '3000', 'Bern', 'CH'],
            ['Weber', 'Clara', 'Hauptgasse 7', '4500', 'Solothurn', 'CH'],
            ['Fischer', 'David', 'Seestrasse 88', '6000', 'Luzern', 'CH'],
            ['Huber', 'Elena', 'Rosenweg 3', '9000', 'St. Gallen', 'CH'],
            ['Schmid', 'Fabian', 'Marktgasse 21', '8400', 'Winterthur', 'CH'],
            ['Brunner', 'Greta', 'Kirchplatz 2', '5000', 'Aarau', 'CH'],
            ['Wagner', 'Hans', 'Bergstrasse 15', '7000', 'Chur', 'CH'],
            ['Keller', 'Ida', 'Gartenweg 9', '3600', 'Thun', 'CH'],
            ['Baumann', 'Jonas', 'Poststrasse 5', '9500', 'Wil', 'CH'],
        ];

        $rows = [];

        // Copy-major order keeps the three cells of a row visually varied.
        for ($copy = 1; $copy <= 3; $copy++) {
            foreach ($people as $person) {
                [$surname, $firstName, $street, $zip, $city, $country] = $person;

                $rows[] = [
                    'name' => $firstName.' '.$surname,
                    'street' => $street,
                    'zip' => $zip,
                    'city' => $city,
                    'country' => $country,
                ];
            }
        }

        return $rows;
    }
}
