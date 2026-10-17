<tr style="border-bottom:1px solid #ddd">
    <td>{{ $ctx->sku }}</td>
    <td>{{ $ctx->name }}</td>
    <td style="text-align:right">{{ number_format((float) $ctx->price, 2, '.', "'") }}</td>
</tr>
