<?php

declare(strict_types=1);

/*
 * Documentation site content. Keeping the navigation and the examples in
 * config (instead of hard-coding them in views) lets the sidebar, the landing
 * page and the examples index share a single source of truth.
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Documentation pages
    |--------------------------------------------------------------------------
    | key => view file + translation key for the page title.
    */
    'pages' => [
        'getting-started' => [
            'view' => 'docs.getting-started',
            'title' => 'site.docs.pages.getting-started',
        ],
        'report-types' => [
            'view' => 'docs.report-types',
            'title' => 'site.docs.pages.report-types',
        ],
        'bands' => [
            'view' => 'docs.bands',
            'title' => 'site.docs.pages.bands',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Example reports
    |--------------------------------------------------------------------------
    | Every example maps to a real report module in app/Reports. `files` are read
    | from disk and highlighted at render time, so the shown code always matches
    | the running report. Text lives in site.examples.items.<key>.
    */
    'examples' => [
        [
            'key' => 'price_list',
            'badges' => ['groups', 'aggregates', 'filters', 'flow'],
            'structure' => implode("\n", [
                'app/Reports/PriceList/',
                '├── Report.php              # bands, groups, filters',
                '├── Source.php              # data + field definitions',
                '└── views/',
                '    ├── report-start.blade.php',
                '    ├── grid-head.blade.php',
                '    ├── row.blade.php',
                '    ├── category-head.blade.php',
                '    ├── category-foot.blade.php',
                '    └── report-end.blade.php',
            ]),
            'files' => [
                ['path' => 'app/Reports/PriceList/Report.php', 'label' => 'Report.php', 'lang' => 'php'],
                ['path' => 'app/Reports/PriceList/Source.php', 'label' => 'Source.php', 'lang' => 'php'],
                ['path' => 'app/Reports/PriceList/views/report-start.blade.php', 'label' => 'views/report-start.blade.php', 'lang' => 'blade'],
                ['path' => 'app/Reports/PriceList/views/grid-head.blade.php', 'label' => 'views/grid-head.blade.php', 'lang' => 'blade'],
                ['path' => 'app/Reports/PriceList/views/row.blade.php', 'label' => 'views/row.blade.php', 'lang' => 'blade'],
                ['path' => 'app/Reports/PriceList/views/category-foot.blade.php', 'label' => 'views/category-foot.blade.php', 'lang' => 'blade'],
                ['path' => 'app/Reports/PriceList/views/report-end.blade.php', 'label' => 'views/report-end.blade.php', 'lang' => 'blade'],
                ['path' => 'app/Reports/Layout/CompanyLayout.php', 'label' => 'Layout/CompanyLayout.php', 'lang' => 'php'],
            ],
        ],
        [
            'key' => 'packing_list',
            'badges' => ['strict', 'pagination'],
            'structure' => implode("\n", [
                'app/Reports/PackingList/',
                '├── Report.php              # strict mode, fixed band heights',
                '├── Source.php              # 60 demo positions',
                '└── views/',
                '    ├── header.blade.php',
                '    ├── grid-head.blade.php',
                '    ├── row.blade.php',
                '    └── footer.blade.php',
            ]),
            'files' => [
                ['path' => 'app/Reports/PackingList/Report.php', 'label' => 'Report.php', 'lang' => 'php'],
                ['path' => 'app/Reports/PackingList/Source.php', 'label' => 'Source.php', 'lang' => 'php'],
                ['path' => 'app/Reports/PackingList/views/header.blade.php', 'label' => 'views/header.blade.php', 'lang' => 'blade'],
                ['path' => 'app/Reports/PackingList/views/row.blade.php', 'label' => 'views/row.blade.php', 'lang' => 'blade'],
            ],
        ],
        [
            'key' => 'label_sheet',
            'badges' => ['strict', 'nup'],
            'structure' => implode("\n", [
                'app/Reports/LabelSheet/',
                '├── Report.php              # strict, columns(4, gap: 3, rowGap: 2)',
                '├── Source.php              # 30 demo labels',
                '└── views/',
                '    ├── header.blade.php',
                '    ├── label.blade.php     # one cell (one record)',
                '    └── footer.blade.php',
            ]),
            'files' => [
                ['path' => 'app/Reports/LabelSheet/Report.php', 'label' => 'Report.php', 'lang' => 'php'],
                ['path' => 'app/Reports/LabelSheet/Source.php', 'label' => 'Source.php', 'lang' => 'php'],
                ['path' => 'app/Reports/LabelSheet/views/header.blade.php', 'label' => 'views/header.blade.php', 'lang' => 'blade'],
                ['path' => 'app/Reports/LabelSheet/views/label.blade.php', 'label' => 'views/label.blade.php', 'lang' => 'blade'],
                ['path' => 'app/Reports/LabelSheet/views/footer.blade.php', 'label' => 'views/footer.blade.php', 'lang' => 'blade'],
            ],
        ],
        [
            'key' => 'invoice_example',
            'badges' => ['strict', 'freeform', 'pagination'],
            'structure' => implode("\n", [
                'app/Reports/InvoiceExample/',
                '├── Report.php              # freeform(), strict, pageNumbering(perForm)',
                '├── Source.php              # two demo invoices',
                '└── views/',
                '    ├── invoice.blade.php   # detail: page-block per invoice section',
                '    ├── header.blade.php    # page 2+ header',
                '    └── footer.blade.php',
            ]),
            'files' => [
                ['path' => 'app/Reports/InvoiceExample/Report.php', 'label' => 'Report.php', 'lang' => 'php'],
                ['path' => 'app/Reports/InvoiceExample/Source.php', 'label' => 'Source.php', 'lang' => 'php'],
                ['path' => 'app/Reports/InvoiceExample/views/invoice.blade.php', 'label' => 'views/invoice.blade.php', 'lang' => 'blade'],
                ['path' => 'app/Reports/InvoiceExample/views/header.blade.php', 'label' => 'views/header.blade.php', 'lang' => 'blade'],
                ['path' => 'app/Reports/InvoiceExample/views/footer.blade.php', 'label' => 'views/footer.blade.php', 'lang' => 'blade'],
            ],
        ],
        [
            'key' => 'contract_example',
            'badges' => ['flow', 'freeform'],
            'structure' => implode("\n", [
                'app/Reports/ContractExample/',
                '├── Report.php              # freeform(), flow, browser pagination',
                '├── Source.php              # one car purchase contract',
                '└── views/',
                '    ├── contract.blade.php  # page 1 + forced page break',
                '    └── terms.blade.php     # general terms from page 2',
            ]),
            'files' => [
                ['path' => 'app/Reports/ContractExample/Report.php', 'label' => 'Report.php', 'lang' => 'php'],
                ['path' => 'app/Reports/ContractExample/Source.php', 'label' => 'Source.php', 'lang' => 'php'],
                ['path' => 'app/Reports/ContractExample/views/contract.blade.php', 'label' => 'views/contract.blade.php', 'lang' => 'blade'],
                ['path' => 'app/Reports/ContractExample/views/terms.blade.php', 'label' => 'views/terms.blade.php', 'lang' => 'blade'],
            ],
        ],
    ],

];
