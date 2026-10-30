<div class="label">
    <div class="label__sender">Acme AG · Beispielstrasse 1 · 8000 Zürich</div>
    <div class="label__name">{{ $ctx->name }}</div>
    <div class="label__address">
        {{ $ctx->street }}<br>
        {{ $ctx->zip }} {{ $ctx->city }}
    </div>
    <div class="label__country">{{ $ctx->country }}</div>
</div>
