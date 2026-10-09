<tr style="font-weight:600; background:#f3f4f6">
    <td colspan="2">Summe {{ $ctx->currentGroup()['key'] }}</td>
    <td style="text-align:right">{{ number_format((float) $ctx->aggregates['category_total'], 2, '.', "'") }}</td>
</tr>
