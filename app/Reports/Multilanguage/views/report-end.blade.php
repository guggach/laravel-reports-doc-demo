<div class="ml-summary">
    <span>{{ $ctx->aggregates['positions'] }} {{ __('multilanguage::report.summary.positions') }}</span>
    <span>{{ __('multilanguage::report.summary.total') }} {{ $ctx->currency($ctx->aggregates['total']) }}</span>
</div>
