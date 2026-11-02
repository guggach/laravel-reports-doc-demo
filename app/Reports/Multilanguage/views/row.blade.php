<div class="ml-row">
    <span class="ml-col-product">{{ $ctx->product }}</span>
    <span class="ml-col-category">{{ $ctx->category }}</span>
    <span class="ml-col-valid">{{ $ctx->date($ctx->valid_from) }}</span>
    <span class="ml-col-status">
        <span class="ml-status ml-status--{{ $ctx->status_key }}">
            {{ $ctx->status }}
        </span>
    </span>
    <span class="ml-col-price">{{ $ctx->currency($ctx->price) }}</span>
</div>
