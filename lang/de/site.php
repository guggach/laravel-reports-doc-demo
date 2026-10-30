<?php

declare(strict_types=1);

return [

    'meta' => [
        'title' => 'Laravel Reports — druckfertige Reports aus Blade',
        'description' => 'Druckfertige, bandbasierte Reports für Laravel: Layouts, Filter, Live-Vorschau und HTML/PDF — in Blade definiert, von Chromium paginiert.',
    ],

    'nav' => [
        'features' => 'Funktionen',
        'examples' => 'Beispiele',
        'docs' => 'Doku',
        'github' => 'GitHub',
        'demo' => 'Live-Demo',
        'language' => 'Sprache',
        'theme' => 'Design wechseln',
        'menu' => 'Menü',
    ],

    'actions' => [
        'copy' => 'Kopieren',
        'copied' => 'Kopiert',
        'open' => 'Öffnen',
        'open_full' => 'Vorschau öffnen',
        'pdf' => 'PDF',
        'code' => 'Code',
        'preview' => 'Vorschau',
    ],

    'hero' => [
        'badge' => 'In Entwicklung',
        'title' => 'Druckfertige Reports, direkt aus Laravel Blade.',
        'lead' => 'Seiten- und Bandmodell, Gruppen mit Summen, Filterformulare, Live-Vorschau und PDF-Export — in eigenständigen Report-Modulen, paginiert von Chromium.',
        'primary' => 'Live-Demo öffnen',
        'secondary' => 'Erste Schritte',
        'proof_1' => 'Flow- & Strict-Paginierung',
        'proof_2' => 'Views direkt beim Report',
        'proof_3' => 'HTML & PDF aus einer Quelle',
    ],

    'features' => [
        'title' => 'Alles, was ein gedruckter Report braucht',
        'lead' => 'Das Paket deckt den Teil ab, den Laravel auslässt: ein Seiten- und Bandmodell mit verlässlicher, wiederholbarer Paginierung.',
        'bands_link_title' => 'Was genau ist ein Band?',
        'bands_link_text' => 'Die beschriftete Preisliste zeigt, was pro Seite, pro Gruppe und pro Datensatz gerendert wird.',
        'bands_link_cta' => 'Bänder erklärt',
        'items' => [
            'bands' => [
                'title' => 'Band- & Seitenmodell',
                'text' => 'Seitenkopf und -fuss, Tabellenköpfe, Detailbänder, verschachtelte Gruppen und Aggregate.',
            ],
            'modes' => [
                'title' => 'Flow & Strict',
                'text' => 'Im Flow-Modus paginiert Chromium; im Strict-Modus werden Bänder mit fixer Höhe arithmetisch platziert.',
            ],
            'modules' => [
                'title' => 'Eigenständige Module',
                'text' => 'Report-Definition, Datenquelle und Blade-Views liegen gemeinsam in einem Ordner unter app/Reports.',
            ],
            'filters' => [
                'title' => 'Filter & Vorschau',
                'text' => 'Typisierte Filter-Controls, ein zweiphasiges Formular und ein Vorschau-Frame mit Zoom und Druck.',
            ],
            'layouts' => [
                'title' => 'Geteilte Layouts',
                'text' => 'Corporate Identity als wiederverwendbares Layout — Briefkopf, Farben und Typografie über alle Reports.',
            ],
            'output' => [
                'title' => 'HTML & PDF',
                'text' => 'Dasselbe HTML speist die Browser-Vorschau und den PDF-Export über einen austauschbaren Contract.',
            ],
        ],
    ],

    'examples' => [
        'title' => 'Live ansehen, Code lesen',
        'lead' => 'Jedes Beispiel ist ein echter Report, der in diesem Playground läuft. Der gezeigte Code wird direkt aus den Dateien gelesen, die die Vorschau erzeugen.',
        'page_title' => 'Beispiel-Reports',
        'page_lead' => 'Jede Funktion des Pakets landet in einem laufenden Beispiel. Vorschau öffnen, Code lesen, übernehmen.',
        'url' => 'Vorschau',
        'code' => 'Code',
        'back' => 'Alle Beispiele',
        'structure' => 'Modul-Struktur',
        'highlights' => 'Was hier typisch ist',
        'files' => 'Dateien',
        'badges' => [
            'flow' => 'Flow',
            'strict' => 'Strict',
            'groups' => 'Gruppen',
            'aggregates' => 'Aggregate',
            'filters' => 'Filter',
            'pagination' => 'Paginierung',
            'nup' => 'N-up',
        ],
        'items' => [
            'price_list' => [
                'title' => 'Preisliste',
                'tagline' => 'Gruppierte Liste mit Zwischensummen',
                'description' => 'Ein Report-Start-Band mit dem Titel, ein Tabellenkopf, ein Detailband, eine Gruppe pro Kategorie mit eigenem Kopf und Fuss, eine summierte Zwischensumme, ein Report-Ende-Band und ein Filterformular.',
                'highlights' => [
                    'Ein reportStart()-Band für den Titel und ein reportEnd()-Band für die Zusammenfassung — einmal pro Report',
                    'Ein Tabellenkopf, danach ein Detailband, das pro Datensatz einmal gerendert wird',
                    'Eine Gruppe pro Kategorie mit eigenen Kopf- und Fuss-Bändern',
                    'Eine Zwischensumme pro Gruppe via aggSum()',
                    'Ein Filterformular mit typisierten Controls (Text, Enum, Number, Relation)',
                ],
            ],
            'packing_list' => [
                'title' => 'Lieferschein',
                'tagline' => 'Strict-Platzierung',
                'description' => 'Bänder mit fixer Höhe, arithmetisch über die Seiten verteilt, mit wiederholtem Tabellenkopf und Seitenzahlen.',
                'highlights' => [
                    'Strict-Modus: fixe Bandhöhen und arithmetische Paginierung',
                    'Ein Tabellenkopf, der auf jeder Seite wiederholt wird',
                    'Seitenzahlen im Seitenfuss',
                    '60 Demo-Positionen, damit der Report mehrere Seiten füllt',
                ],
            ],
            'label_sheet' => [
                'title' => 'Etikettenbogen',
                'tagline' => 'N-up Detailband',
                'description' => 'Ein Detailband über die volle Breite, in vier Zellen pro Zeile aufgeteilt: 30 Etiketten über zwei Seiten, mit der Zeile als Paginationseinheit.',
                'highlights' => [
                    'Ein Detailband, vier Zellen pro Zeile via columns(4, gap: 3, rowGap: 2)',
                    'gap verteilt die Zellen horizontal, rowGap die Zeilen vertikal',
                    'Detail::height ist die Höhe der Zeile, nicht eines einzelnen Etiketts',
                    'Die Engine fasst jede Zeile in ein eigenes Grid — nie ein Grid über mehrere Seiten',
                    'Die letzte Zeile wird mit leeren Zellen aufgefüllt, damit die Spalten bündig bleiben',
                    'Strict-Modus: 7 Zeilen × 4 Etiketten = 28 Etiketten pro Seite, mit Seitenzahlen im Fuss',
                ],
            ],
        ],
    ],

    'quickstart' => [
        'title' => 'In drei Schritten zum Report',
        'lead' => 'Von einer frischen Laravel-App zur paginierten Vorschau.',
        'step_1' => 'Paket installieren',
        'step_1_text' => 'Das Paket wird als Composer-Library verteilt und registriert seinen Service Provider automatisch.',
        'step_2' => 'Report anlegen',
        'step_2_text' => 'Ein Report ist ein eigenständiges Modul unter app/Reports/<Name>: die Report-Definition, die Datenquelle und die Blade-Views. Kein Service Container, keine Registrierung — das Modul wird über seinen Ordner entdeckt.',
        'step_3' => 'Vorschau öffnen',
        'step_3_text' => 'Reports werden über ihren Key angesprochen. Die Vorschau-, Dokument- und PDF-Route registriert das Paket für dich.',
    ],

    'footer' => [
        'tagline' => 'Bandbasierte, druckfertige Reports für Laravel.',
        'built' => 'Gebaut mit Laravel, Blade, Alpine und Tailwind CSS.',
        'rights' => 'Playground für das Paket guggach/laravel-reports.',
        'docs' => 'Dokumentation',
        'examples' => 'Beispiele',
    ],

    'docs' => [
        'title' => 'Dokumentation',
        'lead' => 'Anleitungen zum Erstellen von Reports mit dem Paket.',
        'overview' => 'Übersicht',
        'on_this_page' => 'Dokumentation',
        'pages' => [
            'getting-started' => 'Erste Schritte',
            'report-types' => 'Report-Arten',
            'bands' => 'Bänder erklärt',
        ],
    ],

    'getting-started' => [
        'title' => 'Erste Schritte',
        'lead' => 'Paket installieren, ein Report-Modul anlegen und die Vorschau öffnen. Das dauert rund fünf Minuten.',
        'step_1' => 'Paket installieren',
        'step_1_text' => 'Das Paket wird als Composer-Library verteilt. Es bringt einen Service Provider, eine Konfigurationsdatei und Artisan-Befehle mit.',
        'step_2' => 'Report anlegen',
        'step_2_text' => 'Ein Report lebt in einem eigenständigen Modul: die Report-Klasse, ihre Datenquelle und die Blade-Views daneben.',
        'step_3' => 'Vorschau öffnen',
        'step_3_text' => 'Reports werden über ihren Key angesprochen. Die Vorschau-, Dokument- und PDF-Route registriert das Paket für dich.',
        'next' => 'Weiter',
        'next_text' => 'Bei den Report-Arten siehst du, wie sich Listen, Formulare und Strict-Reports unterscheiden.',
    ],

    'report-types' => [
        'title' => 'Report-Arten',
        'lead' => 'Drei Formen decken die meisten Ausdrucke ab: Spaltenliste, Bandliste und Einzelformular. Alle nutzen dasselbe Bandmodell.',
        'flow_title' => 'Flow-Modus',
        'flow_text' => 'Chromium paginiert den Inhalt. Bänder fliessen natürlich und Seitenumbrüche entstehen dort, wo der Platz ausgeht. Das ist der Standard.',
        'strict_title' => 'Strict-Modus',
        'strict_text' => 'Jedes Band hat eine fixe Höhe, Seiten werden arithmetisch gefüllt. Ideal für Formulare, Etiketten und alles, was exakt sitzen muss.',
        'list_title' => 'Liste',
        'list_text' => 'Ein Detailband, das pro Datensatz wiederholt wird, optional gruppiert mit Kopf, Fuss und Aggregaten.',
        'form_title' => 'Einzelformular',
        'form_text' => 'Ein Formular pro Datensatz, bei mehreren Datensätzen wiederholt, mit eigenem Seitenzähler.',
    ],

    'bands' => [
        'title' => 'Bänder erklärt',
        'lead' => 'Jeder Report ist ein Stapel von Bändern über die volle Seitenbreite. An der Preisliste siehst du, welches Band was rendert — und wie oft.',
        'example_title' => 'Die Preisliste, Band für Band',
        'example_text' => 'Die Preisliste definiert ein Report-Start-Band mit dem Titel, einen Tabellenkopf, ein Detailband, eine Gruppe mit Kopf und Fuss sowie ein Report-Ende-Band mit der Zusammenfassung. Die gerenderte Seite ist das Ergebnis dieser Bänder, die in fester Reihenfolge laufen.',
        'overview_alt' => 'Preisliste mit hervorgehobenen Bändern: Layout-Kopf, Report-Titel, Tabellenkopf, Gruppenkopf, Detailzeilen, Gruppenfuss, Report-Ende und Layout-Fuss.',
        'overview_caption' => 'Die Preisliste aus den Beispielen. L markiert das Layout; die Zahlen markieren Bänder.',
        'legend_title' => 'Legende',
        'legend' => [
            'layout' => [
                'name' => 'Layout (L)',
                'text' => 'Briefkopf und Adresszeile kommen aus CompanyLayout. Das Layout umschliesst jeden Report, ist aber kein Band.',
            ],
            'report_start' => [
                'name' => 'Report-Start / Titel (1)',
                'text' => 'Läuft genau einmal am Beginn des Reports. Hier gehört der Report-Titel hin. Auf Seite 2, 3 und so weiter wird das Band nicht wiederholt.',
            ],
            'grid_header' => [
                'name' => 'Tabellenkopf (2)',
                'text' => 'Leitet die Detailzeilen ein. Hier öffnet er die Tabelle und rendert die Spaltenköpfe; im Strict-Modus wird er zuoberst auf jeder Seite wiederholt.',
            ],
            'group_header' => [
                'name' => 'Gruppenkopf (3)',
                'text' => 'Läuft einmal, wenn sich der Gruppenschlüssel ändert. Die Preisliste gruppiert nach Kategorie, darum bekommen „Küche“ und „Büro“ je einen Kopf.',
            ],
            'detail' => [
                'name' => 'Detailband (4)',
                'text' => 'Läuft einmal pro Datensatz. Jede Preislisten-Zeile ist ein Detaildurchlauf; das Band rendert immer dieselbe Blade-View.',
            ],
            'group_footer' => [
                'name' => 'Gruppenfuss (5)',
                'text' => 'Läuft am Ende einer Gruppe und kann deren Aggregate lesen. Hier druckt er die Zwischensumme der Kategorie.',
            ],
            'report_end' => [
                'name' => 'Report-Ende / Zusammenfassung (6)',
                'text' => 'Läuft genau einmal nach dem letzten Datensatz und hat Zugriff auf die Report-Aggregate. Hier schliesst es die Tabelle und druckt die Anzahl Positionen. Auf späteren Seiten wird es nicht wiederholt.',
            ],
        ],
        'stack_title' => 'Der Bänderstapel',
        'stack_lead' => 'Von aussen nach innen setzt die Engine einen Report in dieser Reihenfolge zusammen. Nicht definierte Bänder werden übersprungen.',
        'scopes' => [
            'page' => '1× pro Seite',
            'report' => '1× pro Report',
            'group' => '1× pro Gruppe',
            'record' => '1× pro Datensatz',
        ],
        'once_title' => 'Report-Bänder laufen einmal — Seitenbänder wiederholen sich',
        'once_text' => 'reportStart() und reportEnd() umschliessen den ganzen Report. Sie laufen genau einmal, egal über wie viele Seiten der Report geht. Nur pageHeader(), gridHeader() und pageFooter() werden im Strict-Modus bei einem neuen Seitenanfang wiederholt.',
        'pages_title' => 'Bänder über Seitenumbrüche hinweg',
        'pages_text' => 'Der Lieferschein macht die Wiederholung sichtbar. Er verwendet den Strict-Modus, in dem jedes Band eine fixe Höhe hat. Seitenkopf, Tabellenkopf und Seitenfuss werden auf jeder Seite wiederholt; das Detailband fährt mit den nächsten Datensätzen fort.',
        'pages_alt' => 'Lieferschein-Seite mit hervorgehobenem Seitenkopf, Tabellenkopf, Detailzeilen und Seitenfuss.',
        'pages_caption' => 'Seite 1 von 3. Derselbe Stapel aus Seitenbändern erscheint auf Seite 2 und 3 wieder.',
        'pages_legend' => [
            'page_header' => 'Seitenkopf',
            'grid_header' => 'Tabellenkopf',
            'detail' => 'Detail',
            'page_footer' => 'Seitenfuss',
        ],
        'code_title' => 'Von der Definition zur Blade-View',
        'code_text' => 'Die Report-Klasse entscheidet, welche Bänder es gibt und welche View sie rendert. Die Blade-Views rendern nur ihren Ausschnitt; die Engine entscheidet, wie oft dieser Ausschnitt läuft.',
        'code_caption' => 'Direkt aus dem laufenden Modul gelesen — der Code passt zur Vorschau.',
        'next' => 'Weiter',
        'next_text' => 'Sieh dir an, wie Listen, Formulare und Strict-Reports diese Bänder kombinieren.',
        'example_link' => 'Preislisten-Beispiel öffnen',
        'example_link_text' => 'Vorschau und Code des Beispiels, das hier erklärt wird.',
    ],
];
