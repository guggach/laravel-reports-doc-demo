<x-reports::page-block :page="$page" :height="0">
<style>
    .invoice-brand {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        border-bottom: 3px solid #0f766e;
        padding-bottom: 4mm;
        height: 100%;
        box-sizing: border-box;
    }
    .invoice-brand__name { font-size: 24px; font-weight: 800; letter-spacing: .02em; color: #0f766e; }
    .invoice-brand__meta { text-align: right; font-size: 9px; line-height: 1.5; color: #475569; }

    .invoice-address { font-size: 10px; line-height: 1.55; color: #1f2937; padding-top: 6mm; box-sizing: border-box; }
    .invoice-address__label { margin-bottom: 3mm; font-size: 9px; color: #64748b; text-transform: uppercase; letter-spacing: .08em; }

    .invoice-title { display: flex; justify-content: space-between; align-items: flex-end; border-bottom: 1px solid #cbd5e1; padding-bottom: 3mm; box-sizing: border-box; }
    .invoice-title h1 { margin: 0; font-size: 22px; line-height: 1; color: #0f172a; }
    .invoice-title__meta { text-align: right; font-size: 10px; line-height: 1.5; color: #475569; }

    .invoice-table-head,
    .invoice-table-row,
    .invoice-total {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 34mm 24mm 28mm 26mm 16mm;
        align-items: center;
        column-gap: 2mm;
        box-sizing: border-box;
    }
    .invoice-table-head {
        border-bottom: 2px solid #0f766e;
        font-size: 8px;
        font-weight: 700;
        line-height: 1.25;
        color: #0f172a;
    }
    .invoice-table-row {
        border-bottom: 1px solid #e2e8f0;
        font-size: 8px;
        line-height: 1.3;
        color: #334155;
        overflow: hidden;
    }
    .invoice-table-row__description { font-weight: 600; color: #0f172a; }
    .invoice-table-row__period { color: #64748b; font-size: 7px; }
    .invoice-table-row .right,
    .invoice-table-head .right { text-align: right; }

    .invoice-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 2px solid #0f172a;
        border-bottom: 1px solid #cbd5e1;
        font-size: 11px;
        font-weight: 700;
    }
    .invoice-total__value { text-align: right; }
    .invoice-note { padding-top: 3mm; font-size: 8px; line-height: 1.5; color: #64748b; }

    .payment-slip {
        box-sizing: border-box;
        height: 100%;
        overflow: hidden;
        background: #fff;
    }
    .payment-slip img { display: block; width: 100%; height: 100%; object-fit: fill; }
</style>
</x-reports::page-block>

<x-reports::page-block :page="$page" :height="24">
    <div class="invoice-brand">
        <div>
            <div class="invoice-brand__name">Acme AG</div>
            <div class="invoice-brand__meta" style="text-align:left">Apartments · Immobilien · IfN</div>
        </div>
        <div class="invoice-brand__meta">
            Beispielstrasse 1<br>
            8000 Zürich<br>
            info@acme.example
        </div>
    </div>
</x-reports::page-block>

<x-reports::page-block :page="$page" :height="36">
    <div class="invoice-address">
        <div class="invoice-address__label">Rechnung für</div>
        <strong>{{ $ctx->customer }}</strong><br>
        @foreach ($ctx->address as $line)
            {{ $line }}<br>
        @endforeach
        <span style="color:#64748b">MWST Nr.: {{ $ctx->vat_number }}</span>
    </div>
</x-reports::page-block>

<x-reports::page-block :page="$page" :height="16">
    <div class="invoice-title">
        <h1>Rechnung</h1>
        <div class="invoice-title__meta">
            {{ $ctx->invoice_number }}<br>
            {{ $ctx->invoice_date }}
        </div>
    </div>
</x-reports::page-block>

<x-reports::page-block :page="$page" :height="8">
    <div class="invoice-table-head">
        <span>Produkt / Beschreibung</span>
        <span>von – bis</span>
        <span>Menge</span>
        <span>Preis</span>
        <span>Betrag</span>
        <span class="right">MWST</span>
    </div>
</x-reports::page-block>

@foreach ($ctx->positions as $position)
    <x-reports::page-block :page="$page" :height="10">
        <div class="invoice-table-row">
            <div>
                <div class="invoice-table-row__description">{{ $position['description'] }}</div>
                <div class="invoice-table-row__period">{{ $position['period'] }}</div>
            </div>
            <span>{{ $position['period'] }}</span>
            <span>{{ $position['quantity'] }}</span>
            <span>{{ number_format($position['unit_price'], 2, '.', "'") }} / Einheit</span>
            <span>{{ number_format($position['total'], 2, '.', "'") }}</span>
            <span class="right">{{ $position['vat'] }}%</span>
        </div>
    </x-reports::page-block>
@endforeach

<x-reports::page-block :page="$page" :height="14">
    <div class="invoice-total">
        <span class="invoice-total__label">Rechnungstotal</span>
        <span class="invoice-total__value">CHF {{ number_format($ctx->invoice_total, 2, '.', "'") }}</span>
    </div>
</x-reports::page-block>

<x-reports::page-block :page="$page" :height="10">
    <div class="invoice-note">
        MWST Betrag CHF {{ number_format($ctx->invoice_vat_total, 2, '.', "'") }} · {{ $ctx->due }}
    </div>
</x-reports::page-block>

<x-reports::page-block :page="$page" :height="105" anchor="bottom">
    <div class="payment-slip">
        <img src="{{ asset('images/docs/swissqr-payment-slip.png') }}" alt="Swiss QR Einzahlungsschein">
    </div>
</x-reports::page-block>
