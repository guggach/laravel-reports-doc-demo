<div class="db-row">
    <span class="db-col-order">{{ $ctx->order_number }}</span>
    <span class="db-col-customer">{{ $ctx->customer }}</span>
    <span class="db-col-category">{{ $ctx->category }}</span>
    <span class="db-col-date">{{ \Illuminate\Support\Carbon::parse($ctx->ordered_at)->format('d.m.Y') }}</span>
    <span class="db-col-status">
        <span class="db-status {{ $ctx->status === 'bezahlt' ? 'db-status--paid' : 'db-status--open' }}">
            {{ $ctx->status }}
        </span>
    </span>
    <span class="db-col-amount">CHF {{ number_format((float) $ctx->amount, 2, '.', "'") }}</span>
</div>
