<style>
    .ge-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 8mm;
        border-bottom: 3px solid #0f766e;
        padding-bottom: 4mm;
        margin-bottom: 4mm;
    }
    .ge-head h1 { margin: 0 0 1mm; font-size: 22px; color: #0f172a; }
    .ge-head p { margin: 0; max-width: 125mm; font-size: 10px; color: #64748b; }
    .ge-locale {
        padding: 2mm 3mm;
        border-radius: 2mm;
        background: #ccfbf1;
        color: #115e59;
        font-size: 9px;
        white-space: nowrap;
    }
    .ge-locale strong { display: block; font-size: 11px; }
    .ge-group {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        gap: 6mm;
        margin-top: 3mm;
        padding: 2.5mm 3mm;
        border-radius: 1.5mm;
        background: #f1f5f9;
        border-left: 3px solid #0f766e;
    }
    .ge-group__name { font-size: 12px; font-weight: 700; color: #0f172a; }
    .ge-group__target { font-size: 9px; color: #475569; font-variant-numeric: tabular-nums; }
    .ge-grid-head,
    .ge-row,
    .ge-subtotal,
    .ge-total {
        display: flex;
        align-items: center;
        gap: 3mm;
        box-sizing: border-box;
    }
    .ge-grid-head {
        height: 8mm;
        margin-top: 2mm;
        border-bottom: 2px solid #0f766e;
        font-size: 8px;
        font-weight: 700;
        color: #0f172a;
    }
    .ge-row {
        min-height: 8mm;
        border-bottom: 1px solid #e2e8f0;
        font-size: 9px;
        color: #334155;
    }
    .ge-col-order { flex: 0 0 30mm; font-weight: 600; color: #0f172a; }
    .ge-col-customer { flex: 1 1 auto; }
    .ge-col-date { flex: 0 0 28mm; color: #64748b; }
    .ge-col-status { flex: 0 0 22mm; }
    .ge-col-amount { flex: 0 0 28mm; text-align: right; font-variant-numeric: tabular-nums; }
    .ge-status {
        display: inline-block;
        padding: 0.8mm 1.6mm;
        border-radius: 1mm;
        font-size: 8px;
        font-weight: 600;
    }
    .ge-status--bezahlt { background: #dcfce7; color: #166534; }
    .ge-status--offen { background: #fef3c7; color: #92400e; }
    .ge-subtotal {
        justify-content: flex-end;
        gap: 6mm;
        padding: 2.5mm 3mm;
        border-bottom: 1px solid #cbd5e1;
        font-size: 10px;
        font-weight: 700;
        color: #0f172a;
    }
    .ge-total {
        justify-content: flex-end;
        gap: 6mm;
        margin-top: 4mm;
        padding-top: 3mm;
        border-top: 2px solid #0f172a;
        font-size: 12px;
        font-weight: 700;
    }
</style>

<div class="ge-head">
    <div>
        <h1>{{ __('group_enrichment::report.title') }}</h1>
        <p>{{ __('group_enrichment::report.intro') }}</p>
    </div>
    <div class="ge-locale">
        {{ __('group_enrichment::report.language_label') }}
        <strong>{{ $ctx->locale }}</strong>
        {{ $ctx->formatLocale }}
    </div>
</div>
