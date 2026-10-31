<div class="contract">
    @foreach ($ctx->terms as $clause)
        <section class="contract-clause">
            <h3>{{ $clause['title'] }}</h3>
            @foreach ($clause['paragraphs'] as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach
        </section>
    @endforeach

    <p style="margin-top:8mm;font-size:8px;color:#64748b">
        Diese Allgemeinen Bedingungen sind Bestandteil des Autokaufvertrags Nr. {{ $ctx->contract_number }}.
        Es gilt das am Vertragsort vereinbarte Recht.
    </p>
</div>
