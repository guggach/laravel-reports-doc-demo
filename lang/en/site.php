<?php

declare(strict_types=1);

return [

    'meta' => [
        'title' => 'Laravel Reports — print-ready reports from Blade',
        'description' => 'Banded, print-ready reports for Laravel: layouts, filters, live preview and HTML/PDF output — defined in Blade, paginated by Chromium.',
    ],

    'nav' => [
        'features' => 'Features',
        'examples' => 'Examples',
        'docs' => 'Docs',
        'github' => 'GitHub',
        'demo' => 'Live demo',
        'language' => 'Language',
        'theme' => 'Toggle theme',
        'menu' => 'Menu',
    ],

    'actions' => [
        'copy' => 'Copy',
        'copied' => 'Copied',
        'open' => 'Open',
        'open_full' => 'Open preview',
        'pdf' => 'PDF',
        'code' => 'Code',
        'preview' => 'Preview',
    ],

    'hero' => [
        'badge' => 'Work in progress',
        'title' => 'Print-ready reports, straight from Laravel Blade.',
        'lead' => 'Page and band model, groups with aggregates, filter forms, a live preview and PDF export — in self-contained report modules, paginated by Chromium.',
        'primary' => 'Open live demo',
        'secondary' => 'Get started',
        'proof_1' => 'Flow & strict pagination',
        'proof_2' => 'Views live next to the report',
        'proof_3' => 'HTML & PDF from one source',
    ],

    'features' => [
        'title' => 'Everything a printed report needs',
        'lead' => 'The package covers the part Laravel leaves out: a page and band model with reliable, repeatable pagination.',
        'bands_link_title' => 'What exactly is a band?',
        'bands_link_text' => 'The annotated price list shows what renders once per page, once per group and once per record.',
        'bands_link_cta' => 'Bands explained',
        'items' => [
            'bands' => [
                'title' => 'Band & page model',
                'text' => 'Page headers and footers, grid headers, detail bands, nested groups and aggregates.',
            ],
            'modes' => [
                'title' => 'Flow & strict',
                'text' => 'Chromium paginates in flow mode; strict mode places fixed-height bands arithmetically.',
            ],
            'modules' => [
                'title' => 'Self-contained modules',
                'text' => 'Report definition, data source and Blade views live together in one folder under app/Reports.',
            ],
            'filters' => [
                'title' => 'Filters & preview',
                'text' => 'Typed filter controls, a two-phase form and a preview frame with zoom and print.',
            ],
            'layouts' => [
                'title' => 'Shared layouts',
                'text' => 'Corporate identity as a reusable layout — letterhead, colours and typography across reports.',
            ],
            'output' => [
                'title' => 'HTML & PDF',
                'text' => 'The same HTML drives the browser preview and the PDF export through a swappable contract.',
            ],
        ],
    ],

    'examples' => [
        'title' => 'See it live, read the code',
        'lead' => 'Each example is a real report running in this playground. The code shown is read from the very files that produce the preview.',
        'page_title' => 'Example reports',
        'page_lead' => 'Every feature of the package lands in a running example. Open the preview, read the code, then adapt it.',
        'url' => 'Preview',
        'code' => 'Code',
        'back' => 'All examples',
        'structure' => 'Module structure',
        'highlights' => 'What is typical here',
        'files' => 'Files',
        'badges' => [
            'flow' => 'Flow',
            'strict' => 'Strict',
            'groups' => 'Groups',
            'aggregates' => 'Aggregates',
            'filters' => 'Filters',
            'pagination' => 'Pagination',
            'nup' => 'N-up',
        ],
        'items' => [
            'price_list' => [
                'title' => 'Price list',
                'tagline' => 'Grouped list with subtotals',
                'description' => 'A report start band with the title, a grid header, a detail band, one group per category with its own header and footer, a summed subtotal, a report end band and a filter form.',
                'highlights' => [
                    'A reportStart() band for the title and a reportEnd() band for the summary — once per report',
                    'A grid header, then a detail band rendered once per record',
                    'A group per category with its own header and footer bands',
                    'A subtotal per group via aggSum()',
                    'A filter form with typed controls (text, enum, number, relation)',
                ],
            ],
            'packing_list' => [
                'title' => 'Packing list',
                'tagline' => 'Strict placement',
                'description' => 'Fixed-height bands placed arithmetically across pages, with a repeated grid header and page numbers.',
                'highlights' => [
                    'Strict mode: fixed band heights and arithmetic pagination',
                    'A repeated grid header on every page',
                    'Page numbers in the page footer',
                    '60 demo positions, so the report spans several pages',
                ],
            ],
            'label_sheet' => [
                'title' => 'Label sheet',
                'tagline' => 'N-up detail band',
                'description' => 'One full-width detail band split into four cells per row: 30 labels across two pages, with the row as the unit of pagination.',
                'highlights' => [
                    'One detail band, four cells per row via columns(4, gap: 3, rowGap: 2)',
                    'gap spaces the cells horizontally, rowGap the rows vertically',
                    'Detail::height is the height of the row, not of a single label',
                    'The engine wraps every row in its own grid — never one grid across pages',
                    'The last row is padded with empty cells so the columns stay aligned',
                    'Strict mode: 7 rows × 4 labels = 28 labels per page, with page numbers in the footer',
                ],
            ],
        ],
    ],

    'quickstart' => [
        'title' => 'Three steps to a report',
        'lead' => 'From a fresh Laravel app to a paginated preview.',
        'step_1' => 'Install the package',
        'step_1_text' => 'The package is distributed as a Composer library and registers its service provider automatically.',
        'step_2' => 'Create a report',
        'step_2_text' => 'A report is a self-contained module under app/Reports/<Name>: the report definition, its data source and the Blade views. No service container, no registration — the module is discovered by its folder.',
        'step_3' => 'Open the preview',
        'step_3_text' => 'Reports are addressed by their key. The package registers the preview, the document and the PDF route for you.',
    ],

    'footer' => [
        'tagline' => 'Banded, print-ready reports for Laravel.',
        'built' => 'Built with Laravel, Blade, Alpine and Tailwind CSS.',
        'rights' => 'Playground for the guggach/laravel-reports package.',
        'docs' => 'Documentation',
        'examples' => 'Examples',
    ],

    'docs' => [
        'title' => 'Documentation',
        'lead' => 'Guides for building reports with the package.',
        'overview' => 'Overview',
        'on_this_page' => 'Documentation',
        'pages' => [
            'getting-started' => 'Getting started',
            'report-types' => 'Report types',
            'bands' => 'Bands explained',
        ],
    ],

    'getting-started' => [
        'title' => 'Getting started',
        'lead' => 'Install the package, create a report module and open the preview. This takes about five minutes.',
        'step_1' => 'Install the package',
        'step_1_text' => 'The package is distributed as a Composer library. It ships a service provider, a config file and Artisan commands.',
        'step_2' => 'Create a report',
        'step_2_text' => 'A report lives in a self-contained module: the report class, its data source and the Blade views next to it.',
        'step_3' => 'Open the preview',
        'step_3_text' => 'Reports are addressed by their key. The package registers the preview, the document and the PDF route for you.',
        'next' => 'Next',
        'next_text' => 'Continue with the report types to see how lists, forms and strict reports differ.',
    ],

    'report-types' => [
        'title' => 'Report types',
        'lead' => 'Three shapes cover most printed output: a column list, a banded list and a single form. All of them use the same band model.',
        'flow_title' => 'Flow mode',
        'flow_text' => 'Chromium paginates the content. Bands flow naturally and page breaks are inserted where the content runs out of space. This is the default.',
        'strict_title' => 'Strict mode',
        'strict_text' => 'Every band has a fixed height and pages are filled arithmetically. Ideal for forms, labels and anything that must land on an exact position.',
        'list_title' => 'List',
        'list_text' => 'A detail band repeated per record, optionally grouped with headers, footers and aggregates.',
        'form_title' => 'Single form',
        'form_text' => 'One form per record, repeated per data set, with its own page counter.',
    ],

    'bands' => [
        'title' => 'Bands explained',
        'lead' => 'Every report is a stack of full-width bands. Using the price list, you can see which band renders what — and how often.',
        'example_title' => 'The price list, band by band',
        'example_text' => 'The price list defines a report start band with the title, a grid header, a detail band, a group with a header and footer, and a report end band with the summary. The rendered page is the result of those bands running in order.',
        'overview_alt' => 'Price list with its bands highlighted: layout header, report start title, grid header, group header, detail rows, group footer, report end and layout footer.',
        'overview_caption' => 'The price list from the examples. L marks layout chrome; the numbers mark bands.',
        'legend_title' => 'Legend',
        'legend' => [
            'layout' => [
                'name' => 'Layout chrome (L)',
                'text' => 'Letterhead and address line come from CompanyLayout. A layout wraps every report that uses it, but it is not a band.',
            ],
            'report_start' => [
                'name' => 'Report start / title (1)',
                'text' => 'Runs exactly once at the beginning of the report. This is where the report title belongs. It does not repeat on page 2, 3, and so on.',
            ],
            'grid_header' => [
                'name' => 'Grid header (2)',
                'text' => 'Introduces the detail rows. Here it opens the table and renders the column headings; in strict mode it is repeated at the top of every page.',
            ],
            'group_header' => [
                'name' => 'Group header (3)',
                'text' => 'Runs once whenever the group key changes. The price list groups by category, so “Küche” and “Büro” each get a header.',
            ],
            'detail' => [
                'name' => 'Detail band (4)',
                'text' => 'Runs once per record. Each price-list row is one detail run; the band always renders the same Blade view.',
            ],
            'group_footer' => [
                'name' => 'Group footer (5)',
                'text' => 'Runs when a group ends and can read its aggregates. Here it prints the subtotal for the category.',
            ],
            'report_end' => [
                'name' => 'Report end / summary (6)',
                'text' => 'Runs exactly once after the last record and has access to the report aggregates. Here it closes the table and prints the position count. It is not repeated on later pages.',
            ],
        ],
        'stack_title' => 'The band stack',
        'stack_lead' => 'From the outside in, the engine assembles a report in this order. Undefined bands are skipped.',
        'scopes' => [
            'page' => 'once per page',
            'report' => 'once per report',
            'group' => 'once per group',
            'record' => 'once per record',
        ],
        'once_title' => 'Report bands run once — page bands repeat',
        'once_text' => 'reportStart() and reportEnd() wrap the whole report. They run exactly once, no matter how many pages the report spans. Only pageHeader(), gridHeader() and pageFooter() are repeated when a new page starts in strict mode.',
        'pages_title' => 'Bands across page breaks',
        'pages_text' => 'The packing list makes the repetition visible. It uses strict mode, where every band has a fixed height. Page header, grid header and page footer repeat on every page, while the detail band continues with the next records.',
        'pages_alt' => 'Packing list page with page header, grid header, detail rows and page footer highlighted.',
        'pages_caption' => 'Page 1 of 3. The same stack of page bands returns on pages 2 and 3.',
        'pages_legend' => [
            'page_header' => 'Page header',
            'grid_header' => 'Grid header',
            'detail' => 'Detail',
            'page_footer' => 'Page footer',
        ],
        'code_title' => 'From definition to Blade',
        'code_text' => 'The report class decides which bands exist and which view renders each one. The Blade views only render their fragment; the engine decides how often the fragment runs.',
        'code_caption' => 'Read from the running module, so the code matches the preview.',
        'next' => 'Next',
        'next_text' => 'See how lists, forms and strict reports combine these bands.',
        'example_link' => 'Open the price list example',
        'example_link_text' => 'Preview and code of the report explained here.',
    ],
];
