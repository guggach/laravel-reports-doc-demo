<style>
    .contract {
        font-size: 10px;
        line-height: 1.55;
        color: #1f2937;
    }
    .contract-brand {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        border-bottom: 3px solid #0f766e;
        padding-bottom: 4mm;
        margin-bottom: 8mm;
    }
    .contract-brand__name { font-size: 24px; font-weight: 800; color: #0f766e; letter-spacing: .02em; }
    .contract-brand__meta { text-align: right; font-size: 9px; line-height: 1.5; color: #475569; }

    .contract-title { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 7mm; }
    .contract-title h1 { margin: 0; font-size: 22px; line-height: 1.1; }
    .contract-title__meta { text-align: right; font-size: 9px; line-height: 1.5; color: #475569; }

    .contract-party-grid,
    .contract-vehicle-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 6mm 12mm;
    }
    .contract-party-grid { margin-bottom: 7mm; }
    .contract-party { border-top: 1px solid #cbd5e1; padding-top: 3mm; }
    .contract-label { margin-bottom: 1mm; font-size: 8px; text-transform: uppercase; letter-spacing: .08em; color: #64748b; }

    .contract-section-title {
        margin: 7mm 0 2mm;
        font-size: 11px;
        font-weight: 700;
        color: #0f172a;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 1mm;
    }
    .contract-table { width: 100%; border-collapse: collapse; font-size: 9px; }
    .contract-table th,
    .contract-table td { padding: 2mm 0; border-bottom: 1px solid #e2e8f0; text-align: left; vertical-align: top; }
    .contract-table th { width: 38mm; color: #64748b; font-weight: 400; }
    .contract-price { font-size: 13px; font-weight: 700; }

    .contract-signatures { display: grid; grid-template-columns: 1fr 1fr; gap: 20mm; margin-top: 14mm; }
    .contract-signature { border-top: 1px solid #64748b; padding-top: 2mm; font-size: 8px; color: #64748b; }

    .contract-terms-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        border-bottom: 2px solid #0f766e;
        padding-bottom: 3mm;
        margin-bottom: 7mm;
    }
    .contract-terms-head h2 { margin: 0; font-size: 18px; }
    .contract-terms-head__meta { text-align: right; font-size: 9px; color: #64748b; }
    .contract-clause { break-inside: avoid; page-break-inside: avoid; margin-bottom: 5mm; }
    .contract-clause h3 { margin: 0 0 1.5mm; font-size: 11px; }
    .contract-clause p { margin: 0 0 2mm; orphans: 3; widows: 3; }

    @media screen {
        /* Flow has one continuous sheet on screen; mark the forced print break. */
        .contract-page-break { border-top: 2px dashed #94a3b8; padding-top: 8mm; }
    }
</style>

<article class="contract">
    <header class="contract-brand">
        <div>
            <div class="contract-brand__name">Acme Garage AG</div>
            <div class="contract-brand__meta" style="text-align:left">Automobile · Service · Finanzierung</div>
        </div>
        <div class="contract-brand__meta">
            Beispielstrasse 1<br>
            8000 Zürich<br>
            garage@acme.example
        </div>
    </header>

    <div class="contract-title">
        <h1>Autokaufvertrag</h1>
        <div class="contract-title__meta">
            Vertrag Nr. {{ $ctx->contract_number }}<br>
            {{ $ctx->contract_date }}
        </div>
    </div>

    <div class="contract-party-grid">
        <div class="contract-party">
            <div class="contract-label">Verkäuferin</div>
            <strong>{{ $ctx->seller['name'] }}</strong><br>
            {{ $ctx->seller['street'] }}<br>
            {{ $ctx->seller['city'] }}<br>
            {{ $ctx->seller['commercial_register'] }}
        </div>
        <div class="contract-party">
            <div class="contract-label">Käufer</div>
            <strong>{{ $ctx->buyer['name'] }}</strong><br>
            {{ $ctx->buyer['street'] }}<br>
            {{ $ctx->buyer['city'] }}
        </div>
    </div>

    <h2 class="contract-section-title">1. Fahrzeug</h2>
    <table class="contract-table">
        <tr><th>Marke / Modell</th><td>{{ $ctx->vehicle['make'] }} {{ $ctx->vehicle['model'] }}</td></tr>
        <tr><th>Jahrgang</th><td>{{ $ctx->vehicle['year'] }}</td></tr>
        <tr><th>Fahrgestellnummer</th><td>{{ $ctx->vehicle['vin'] }}</td></tr>
        <tr><th>Kilometerstand</th><td>{{ $ctx->vehicle['mileage'] }}</td></tr>
        <tr><th>Farbe</th><td>{{ $ctx->vehicle['colour'] }}</td></tr>
        <tr><th>Kontrollschild</th><td>{{ $ctx->vehicle['plate'] }}</td></tr>
    </table>

    <h2 class="contract-section-title">2. Kaufpreis und Zahlung</h2>
    <table class="contract-table">
        <tr><th>Kaufpreis inkl. MWST</th><td class="contract-price">CHF {{ number_format($ctx->price, 2, '.', "'") }}</td></tr>
        <tr><th>Anzahlung bei Vertragsabschluss</th><td>CHF {{ number_format($ctx->deposit, 2, '.', "'") }}</td></tr>
        <tr><th>Restbetrag bei Übergabe</th><td>CHF {{ number_format($ctx->price - $ctx->deposit, 2, '.', "'") }}</td></tr>
        <tr><th>Übergabe</th><td>{{ $ctx->delivery }}</td></tr>
    </table>

    <h2 class="contract-section-title">3. Besondere Vereinbarungen</h2>
    <p>Das Fahrzeug wird im aktuellen Zustand verkauft. Die Verkäuferin bestätigt, dass keine offenen Leasing- oder Pfandrechte bestehen. Service und Hauptuntersuchung werden vor der Übergabe durchgeführt. Der Käufer ist mit der Übermittlung der Fahrzeugdaten an die zuständige Zulassungsstelle einverstanden.</p>

    <div class="contract-signatures">
        <div class="contract-signature">Ort, Datum / Verkäuferin</div>
        <div class="contract-signature">Ort, Datum / Käufer</div>
    </div>
</article>

<x-reports::page-break />

<section class="contract-page-break">
    <div class="contract-terms-head">
        <h2>Allgemeine Bedingungen</h2>
        <div class="contract-terms-head__meta">
            Autokaufvertrag Nr. {{ $ctx->contract_number }}<br>
            {{ $ctx->seller['name'] }} · {{ $ctx->buyer['name'] }}
        </div>
    </div>

    @include('contract_example::terms')
</section>
