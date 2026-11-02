<style>
    .ml-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 8mm;
        border-bottom: 3px solid #1d4ed8;
        padding-bottom: 4mm;
        margin-bottom: 5mm;
    }
    .ml-head h1 { margin: 0 0 1mm; font-size: 22px; color: #0f172a; }
    .ml-head p { margin: 0; font-size: 10px; color: #64748b; max-width: 120mm; }
    .ml-locale {
        display: flex;
        gap: 4mm;
        padding: 2mm 3mm;
        border-radius: 2mm;
        background: #dbeafe;
        color: #1e40af;
        font-size: 9px;
        white-space: nowrap;
    }
    .ml-locale strong { display: block; font-size: 11px; }
    .ml-grid-head,
    .ml-row {
        display: flex;
        align-items: center;
        gap: 3mm;
        box-sizing: border-box;
    }
    .ml-grid-head {
        height: 9mm;
        border-bottom: 2px solid #1d4ed8;
        font-size: 8px;
        font-weight: 700;
        color: #0f172a;
    }
    .ml-row {
        min-height: 9mm;
        border-bottom: 1px solid #e2e8f0;
        font-size: 9px;
        color: #334155;
    }
    .ml-col-product { flex: 1 1 auto; font-weight: 600; color: #0f172a; }
    .ml-col-category { flex: 0 0 24mm; }
    .ml-col-valid { flex: 0 0 28mm; color: #64748b; }
    .ml-col-status { flex: 0 0 22mm; }
    .ml-col-price { flex: 0 0 28mm; text-align: right; font-variant-numeric: tabular-nums; }
    .ml-status {
        display: inline-block;
        padding: 0.8mm 1.6mm;
        border-radius: 1mm;
        font-size: 8px;
        font-weight: 600;
    }
    .ml-status--active { background: #dcfce7; color: #166534; }
    .ml-status--draft { background: #fef3c7; color: #92400e; }
    .ml-summary {
        display: flex;
        justify-content: flex-end;
        gap: 10mm;
        margin-top: 4mm;
        padding-top: 3mm;
        border-top: 2px solid #0f172a;
        font-size: 11px;
        font-weight: 700;
    }
</style>

<div class="ml-head">
    <div>
        <h1>{{ __('multilanguage::report.title') }}</h1>
        <p>{{ __('multilanguage::report.intro') }}</p>
    </div>
    <div class="ml-locale">
        <span>
            {{ __('multilanguage::report.language_label') }}
            <strong>{{ $ctx->locale }}</strong>
        </span>
        <span>
            {{ __('multilanguage::report.format_label') }}
            <strong>{{ $ctx->formatLocale }}</strong>
        </span>
    </div>
</div>
