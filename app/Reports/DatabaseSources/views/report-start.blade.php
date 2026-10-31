@php
    $selected = $ctx->filters['source'] ?? 'query';

    if (is_array($selected)) {
        $selected = $selected['value'] ?? $selected[0] ?? 'query';
    }

    $labels = \App\Reports\DatabaseSources\Report::sourceLabels();
@endphp

<style>
    .db-demo-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 8mm;
        border-bottom: 3px solid #0f766e;
        padding-bottom: 4mm;
        margin-bottom: 5mm;
    }
    .db-demo-head h1 { margin: 0 0 1mm; font-size: 22px; color: #0f172a; }
    .db-demo-head p { margin: 0; font-size: 10px; color: #64748b; }
    .db-source-badge {
        padding: 2mm 3mm;
        border-radius: 2mm;
        background: #ccfbf1;
        color: #0f766e;
        font-size: 9px;
        font-weight: 700;
        white-space: nowrap;
    }
    .db-source-hint {
        margin-bottom: 5mm;
        padding: 2.5mm 3mm;
        background: #f8fafc;
        border-left: 3px solid #0f766e;
        font-size: 9px;
        color: #475569;
    }
    .db-grid-head,
    .db-row {
        display: flex;
        align-items: center;
        gap: 3mm;
        box-sizing: border-box;
    }
    .db-grid-head {
        height: 9mm;
        border-bottom: 2px solid #0f766e;
        font-size: 8px;
        font-weight: 700;
        color: #0f172a;
    }
    .db-row {
        min-height: 9mm;
        border-bottom: 1px solid #e2e8f0;
        font-size: 9px;
        color: #334155;
    }
    .db-col-order { flex: 0 0 30mm; font-weight: 600; color: #0f172a; }
    .db-col-customer { flex: 1 1 auto; }
    .db-col-category { flex: 0 0 22mm; }
    .db-col-date { flex: 0 0 22mm; color: #64748b; }
    .db-col-status { flex: 0 0 20mm; }
    .db-col-amount { flex: 0 0 24mm; text-align: right; font-variant-numeric: tabular-nums; }
    .db-status {
        display: inline-block;
        padding: 0.8mm 1.6mm;
        border-radius: 1mm;
        font-size: 8px;
        font-weight: 600;
    }
    .db-status--paid { background: #dcfce7; color: #166534; }
    .db-status--open { background: #fef3c7; color: #92400e; }
    .db-summary {
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

<div class="db-demo-head">
    <div>
        <h1>Datenquellen</h1>
        <p>Dieselben SQLite-Daten, gerendert durch den gewählten Source-Adapter.</p>
    </div>
    <div class="db-source-badge">{{ $labels[$selected] ?? $selected }}</div>
</div>

<div class="db-source-hint">
    Wähle im Filterformular eine andere Quelle. Alle fünf Adapter lesen dieselbe Tabelle
    <code>demo_orders</code>; Query- und Eloquent-Source filtern und sortieren per SQL,
    die übrigen Adapter in-memory.
</div>
