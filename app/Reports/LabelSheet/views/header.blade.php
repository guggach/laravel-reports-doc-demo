<style>
    .sheet-head {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        border-bottom: 1px solid #cbd5e1;
        padding-bottom: 4px;
        font-family: sans-serif;
        color: #0f172a;
    }
    .sheet-head strong { font-size: 14px; }
    .sheet-head span { font-size: 10px; color: #64748b; }

    /* The engine owns the row/cell wrapper; this view styles the cell content. */
    .label {
        box-sizing: border-box;
        height: 100%;
        padding: 6px 8px;
        border: 1px solid #94a3b8;
        border-radius: 2px;
        overflow: hidden;
        font-family: sans-serif;
        color: #0f172a;
        background: #fff;
    }
    .label__sender {
        font-size: 7px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: .06em;
        white-space: nowrap;
    }
    .label__name {
        margin-top: 4px;
        font-size: 12px;
        font-weight: 700;
        line-height: 1.2;
    }
    .label__address {
        margin-top: 2px;
        font-size: 10px;
        line-height: 1.35;
    }
    .label__country {
        margin-top: 4px;
        font-size: 8px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: .08em;
    }
</style>

<div class="sheet-head">
    <strong>Acme AG · Versandetiketten</strong>
    <span>4 Etiketten pro Zeile · N-up Detailband</span>
</div>
