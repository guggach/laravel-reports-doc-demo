@php($info = $ctx->groupData())

<div class="ge-group">
    <span class="ge-group__name">
        {{ $info?->name ?? $ctx->currentGroup()['key'] }}
    </span>
    @if ($info)
        <span class="ge-group__target">
            {{ __('group_enrichment::report.summary.target') }}
            {{ $ctx->currency($info->target) }}
        </span>
    @endif
</div>
