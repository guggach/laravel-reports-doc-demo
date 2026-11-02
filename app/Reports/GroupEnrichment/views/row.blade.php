<div class="ge-row">
    <span class="ge-col-order">{{ $ctx->order_number }}</span>
    <span class="ge-col-customer">{{ $ctx->customer }}</span>
    <span class="ge-col-date">{{ $ctx->date($ctx->ordered_at) }}</span>
    <span class="ge-col-status">
        <span class="ge-status ge-status--{{ $ctx->status }}">
            {{ __('group_enrichment::report.status.'.$ctx->status) }}
        </span>
    </span>
    <span class="ge-col-amount">{{ $ctx->currency($ctx->amount) }}</span>
</div>
