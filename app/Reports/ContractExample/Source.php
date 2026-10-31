<?php

declare(strict_types=1);

namespace App\Reports\ContractExample;

use Guggach\Reports\Sources\ReportSource;

/**
 * Demo car purchase contract with general terms. The terms are long enough to
 * show natural Flow pagination after the forced break onto page 2.
 */
final class Source extends ReportSource
{
    public function records(): iterable
    {
        return [[
            'contract_number' => 'KV-2026-0042',
            'contract_date' => '31.10.2026',
            'seller' => [
                'name' => 'Acme Garage AG',
                'street' => 'Beispielstrasse 1',
                'city' => '8000 Zürich',
                'commercial_register' => 'CHE-106.833.447 MWST',
            ],
            'buyer' => [
                'name' => 'Mara Beispiele',
                'street' => 'Seefeldstrasse 12',
                'city' => '8008 Zürich',
            ],
            'vehicle' => [
                'make' => 'Volvo',
                'model' => 'V60 Recharge T6',
                'year' => '2024',
                'vin' => 'YV1ZWK8V1P1234567',
                'mileage' => '18\'400 km',
                'colour' => 'Denim Blue',
                'plate' => 'ZH 123 456',
            ],
            'price' => 48900.00,
            'deposit' => 5000.00,
            'delivery' => '30.11.2026',
            'terms' => [
                [
                    'title' => '1. Kaufgegenstand',
                    'paragraphs' => [
                        'Die Verkäuferin verkauft dem Käufer das im Vertragskopf beschriebene Fahrzeug zu den dort genannten Bedingungen. Der Verkauf erfolgt unter Ausschluss der Weiterveräusserung von Fahrzeugdaten zu Werbezwecken.',
                        'Der Käufer bestätigt, das Fahrzeug vor Vertragsabschluss besichtigt und eine Probefahrt durchgeführt zu haben. Die Laufleistung entspricht dem bei der Übergabe abgelesenen Kilometerstand; Rundungsdifferenzen von bis zu 100 Kilometern sind zulässig.',
                    ],
                ],
                [
                    'title' => '2. Kaufpreis und Zahlung',
                    'paragraphs' => [
                        'Der Kaufpreis beträgt CHF 48\'900.00 und versteht sich inklusive der gesetzlichen Mehrwertsteuer. Eine Anzahlung von CHF 5\'000.00 ist bei Vertragsunterzeichnung fällig.',
                        'Der Restbetrag ist spätestens bei der Übergabe des Fahrzeugs ohne Abzug zu bezahlen. Zahlungen gelten erst mit Gutschrift auf dem Konto der Verkäuferin als geleistet. Bei Zahlungsverzug ist die Verkäuferin berechtigt, Verzugszinsen von 5 % pro Jahr geltend zu machen.',
                    ],
                ],
                [
                    'title' => '3. Übergabe und Nutzen',
                    'paragraphs' => [
                        'Die Übergabe erfolgt am 30.11.2026 am Geschäftssitz der Verkäuferin. Nutzen und Gefahr gehen mit der Übergabe auf den Käufer über. Der Käufer ist verpflichtet, das Fahrzeug innert 10 Tagen nach Übergabe auf seinen Namen umzumelden.',
                        'Die Verkäuferin übergibt dem Käufer bei der Übergabe sämtliche Fahrzeugdokumente, den Fahrzeugausweis, die Servicehistorie sowie zwei Fahrzeugschlüssel. Allfällige Leasing- oder Pfandrechte werden vor der Übergabe vollständig abgelöst.',
                    ],
                ],
                [
                    'title' => '4. Gewährleistung',
                    'paragraphs' => [
                        'Die Verkäuferin gewährleistet, dass das Fahrzeug zum Zeitpunkt der Übergabe frei von wesentlichen Mängeln ist und den vertraglich vereinbarten Eigenschaften entspricht. Die gesetzliche Gewährleistungsfrist beträgt zwei Jahre ab Übergabe.',
                        'Verschleissteile, Reifen, Bremsbeläge und Flüssigkeiten fallen nicht unter die Gewährleistung, soweit sie nicht bereits bei der Übergabe mangelhaft waren. Der Käufer hat Mängel unverzüglich, spätestens innert fünf Werktagen nach Entdeckung, schriftlich zu melden.',
                        'Die Verkäuferin ist berechtigt, Mängel nach ihrer Wahl durch Nachbesserung oder Ersatzlieferung zu beheben. Schlägt die Nachbesserung zweimal fehl, kann der Käufer eine angemessene Minderung des Kaufpreises verlangen.',
                    ],
                ],
                [
                    'title' => '5. Haftung',
                    'paragraphs' => [
                        'Die Haftung der Verkäuferin für leichte Fahrlässigkeit ist ausgeschlossen, soweit es sich nicht um die Verletzung von Leben, Körper oder Gesundheit oder um die Verletzung wesentlicher Vertragspflichten handelt. Die Haftung für mittelbare Schäden und entgangenen Gewinn ist ausgeschlossen.',
                        'Der Käufer haftet für Schäden, die durch unsachgemässe Nutzung des Fahrzeugs nach der Übergabe entstehen. Er stellt die Verkäuferin von Ansprüchen Dritter frei, die auf eine solche Nutzung zurückgehen.',
                    ],
                ],
                [
                    'title' => '6. Datenschutz',
                    'paragraphs' => [
                        'Die Verkäuferin bearbeitet die Personendaten des Käufers ausschliesslich zur Abwicklung des Kaufvertrags sowie zur Erfüllung gesetzlicher Pflichten. Eine Weitergabe an Dritte erfolgt nur, soweit dies für die Vertragsabwicklung oder aufgrund gesetzlicher Vorschriften erforderlich ist.',
                        'Der Käufer kann Auskunft über die zu seiner Person bearbeiteten Daten verlangen. Die Daten werden nach Ablauf der gesetzlichen Aufbewahrungsfristen gelöscht oder anonymisiert.',
                    ],
                ],
                [
                    'title' => '7. Gerichtsstand und anwendbares Recht',
                    'paragraphs' => [
                        'Auf diesen Vertrag findet ausschliesslich schweizerisches Recht Anwendung, unter Ausschluss des Übereinkommens der Vereinten Nationen über Verträge über den internationalen Warenkauf.',
                        'Ausschliesslicher Gerichtsstand für alle Streitigkeiten aus oder im Zusammenhang mit diesem Vertrag ist Zürich. Die Verkäuferin bleibt berechtigt, am Wohnsitz des Käufers zu klagen.',
                    ],
                ],
                [
                    'title' => '8. Versicherung und Zulassung',
                    'paragraphs' => [
                        'Der Käufer ist verpflichtet, das Fahrzeug ab dem Zeitpunkt der Übergabe ausreichend zu versichern. Der Nachweis einer Haftpflichtversicherung ist bei der Übergabe vorzulegen, sofern das Fahrzeug nicht bereits durch die Verkäuferin für den Käufer versichert wurde.',
                        'Die Verkäuferin unterstützt den Käufer bei der Umschreibung des Fahrzeugs, bleibt jedoch für die fristgerechte Anmeldung nicht verantwortlich. Allfällige Gebühren der Zulassungsstelle trägt der Käufer.',
                        'Bis zur vollständigen Bezahlung des Kaufpreises bleibt das Fahrzeug Eigentum der Verkäuferin. Der Käufer ist verpflichtet, das Fahrzeug in diesem Fall sorgfältig zu behandeln und die Verkäuferin über einen Wechsel des Standorts zu informieren.',
                    ],
                ],
                [
                    'title' => '9. Rücktritt und Nichterfüllung',
                    'paragraphs' => [
                        'Gerät der Käufer mit der Zahlung des Restbetrags mehr als 14 Tage in Verzug, kann die Verkäuferin nach schriftlicher Mahnung vom Vertrag zurücktreten. Bereits geleistete Zahlungen werden nach Abzug der entstandenen Kosten zurückerstattet.',
                        'Die Verkäuferin kann vom Vertrag zurücktreten, wenn das Fahrzeug vor der Übergabe durch einen nicht von ihr verschuldeten Umstand untergeht oder nicht mehr verfügbar ist. In diesem Fall werden bereits geleistete Zahlungen vollumfänglich zurückerstattet.',
                        'Weitergehende Ansprüche des Käufers, insbesondere auf Schadenersatz wegen Nichterfüllung, richten sich nach den gesetzlichen Bestimmungen und den Regelungen zur Haftung in diesem Vertrag.',
                    ],
                ],
                [
                    'title' => '10. Schlussbestimmungen',
                    'paragraphs' => [
                        'Änderungen und Ergänzungen dieses Vertrags bedürfen der Schriftform. Sollte eine Bestimmung dieses Vertrags unwirksam sein oder werden, bleibt die Wirksamkeit der übrigen Bestimmungen unberührt. An die Stelle der unwirksamen Bestimmung tritt die gesetzlich zulässige Regelung, die dem wirtschaftlichen Zweck am nächsten kommt.',
                        'Der Käufer bestätigt, den Vertrag gelesen und verstanden zu haben. Er erhält ein vollständig unterzeichnetes Exemplar dieses Vertrags. Die Allgemeinen Bedingungen sind integrierender Bestandteil des Vertrags.',
                        'Dieser Vertrag tritt mit der Unterzeichnung durch beide Parteien in Kraft. Mündliche Nebenabreden bestehen nicht.',
                    ],
                ],
            ],
        ]];
    }
}
