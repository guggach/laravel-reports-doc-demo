<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

uses(RefreshDatabase::class);

function loadExcelExport(string $bytes): Spreadsheet
{
    $path = sys_get_temp_dir().'/excel-export-test-'.uniqid('', true).'.xlsx';
    file_put_contents($path, $bytes);

    try {
        return IOFactory::load($path);
    } finally {
        @unlink($path);
    }
}

it('downloads the order list as a typed xlsx workbook', function (): void {
    $response = $this->get('/reports/excel_export/xlsx');

    $response->assertOk();
    $response->assertHeader(
        'content-type',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    );
    $response->assertHeader('content-disposition', 'attachment; filename="excel_export.xlsx"');

    $content = (string) $response->getContent();
    expect($content)->toStartWith('PK');

    $sheet = loadExcelExport($content)->getActiveSheet();

    expect($sheet->getTitle())->toBe('Order list (Excel export)')
        ->and($sheet->getCell('A4')->getValue())->toBe('Order')
        ->and($sheet->getCell('B4')->getValue())->toBe('Customer')
        ->and($sheet->getCell('C4')->getValue())->toBe('Category')
        ->and($sheet->getCell('D4')->getValue())->toBe('Amount')
        ->and($sheet->getCell('E4')->getValue())->toBe('Ordered at')
        ->and($sheet->getCell('F4')->getValue())->toBe('Status')
        ->and($sheet->getCell('A5')->getValue())->toBe('AU-2026-1001')
        ->and($sheet->getCell('C5')->getValue())->toBe('Rent')
        ->and((float) $sheet->getCell('D5')->getValue())->toBe(2400.0)
        ->and($sheet->getStyle('D5')->getNumberFormat()->getFormatCode())->toBe('"CHF" #,##0.00')
        ->and($sheet->getCell('E5')->getFormattedValue())->toBe('09/18/2026')
        ->and($sheet->getCell('F5')->getValue())->toBe('Paid')
        ->and($sheet->getFreezePane())->toBe('A5')
        ->and($sheet->getAutoFilter()->getRange())->toBe('A4:F16')
        ->and($sheet->getCell('A17')->getValue())->toBe('Total')
        ->and((float) $sheet->getCell('D17')->getValue())->toBe(45663.35);
});

it('formats the workbook for the requested locale', function (): void {
    $response = $this->get('/reports/excel_export/xlsx?locale=de');

    $response->assertOk();

    $sheet = loadExcelExport((string) $response->getContent())->getActiveSheet();

    expect($sheet->getTitle())->toBe('Auftragsliste (Excel-Export)')
        ->and($sheet->getCell('A4')->getValue())->toBe('Auftrag')
        ->and($sheet->getCell('C5')->getValue())->toBe('Miete')
        ->and($sheet->getCell('E5')->getFormattedValue())->toBe('18.09.2026')
        ->and($sheet->getStyle('E5')->getNumberFormat()->getFormatCode())->toBe('dd.mm.yyyy');
});

it('applies the report filters to the workbook', function (): void {
    $response = $this->get('/reports/excel_export/xlsx?category=Miete');

    $response->assertOk();

    $sheet = loadExcelExport((string) $response->getContent())->getActiveSheet();

    expect($sheet->getCell('A5')->getValue())->toBe('AU-2026-1001')
        ->and($sheet->getCell('A10')->getValue())->toBe('Total')
        ->and((float) $sheet->getCell('D10')->getValue())->toBe(12233.35);
});

it('renders the filter form for the excel example', function (): void {
    $this->get('/reports/excel_export')
        ->assertOk()
        ->assertSee('Category')
        ->assertSee('Status')
        ->assertSee('Rent');
});

it('renders the html preview of the excel example', function (): void {
    $this->get('/reports/internal/excel_export')
        ->assertOk()
        ->assertSee('Order list (Excel export)')
        ->assertSee('AU-2026-1001')
        ->assertSee('2,400.00', false);

    $this->get('/reports/excel_export/run')
        ->assertOk()
        ->assertSee('report-frame', false)
        ->assertSee('/reports/excel_export/xlsx', false);
});

it('shows the excel download on the example page', function (): void {
    $this->get('/examples/excel_export')
        ->assertOk()
        ->assertSee('Order list with Excel export')
        ->assertSee('/reports/excel_export/xlsx', false);
});

it('documents the excel export in both languages', function (): void {
    $this->get('/docs/excel')
        ->assertOk()
        ->assertSee('Excel export')
        ->assertSee('PhpSpreadsheet');

    $this->get('/de/docs/excel')
        ->assertOk()
        ->assertSee('Excel-Export')
        ->assertSee('PhpSpreadsheet');
});
