<div class="db-summary">
    <span>{{ $ctx->aggregates['orders'] }} Aufträge</span>
    <span>Total CHF {{ number_format((float) $ctx->aggregates['total'], 2, '.', "'") }}</span>
</div>
