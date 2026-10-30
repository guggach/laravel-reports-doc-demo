<style>
    .invoice-page-head {
        display: grid;
        grid-template-columns: 1fr 1fr auto;
        align-items: end;
        column-gap: 6mm;
        height: 100%;
        box-sizing: border-box;
        border-bottom: 1px solid #cbd5e1;
        padding-bottom: 2mm;
        font-size: 9px;
        line-height: 1.5;
        color: #334155;
    }
    .invoice-page-head strong { color: #0f172a; }
    .invoice-page-head__label { color: #64748b; font-size: 8px; text-transform: uppercase; letter-spacing: .08em; }
</style>

<div class="invoice-page-head">
    <div>
        <div class="invoice-page-head__label">Rechnung Nr.</div>
        <strong>{{ $ctx->invoice_number }}</strong>
    </div>
    <div>
        <div class="invoice-page-head__label">Rechnung für</div>
        <strong>{{ $ctx->customer }}</strong>
    </div>
    <div style="text-align:right">
        <div class="invoice-page-head__label">Seite</div>
        <strong>{{ $ctx->page['number'] }} / {{ $ctx->page['total'] }}</strong>
    </div>
</div>
