@php
    $categories = [
        'Miete' => __('excel_export::report.categories.rent'),
        'Service' => __('excel_export::report.categories.service'),
        'Verkauf' => __('excel_export::report.categories.sale'),
    ];
    $statuses = [
        'offen' => __('excel_export::report.status.open'),
        'bezahlt' => __('excel_export::report.status.paid'),
    ];
@endphp

<tr style="border-bottom:1px solid #e2e8f0">
    <td style="padding:5px 6px; font-size:9px; font-weight:600; color:#0f172a">{{ $ctx->order_number }}</td>
    <td style="padding:5px 6px; font-size:9px; color:#334155">{{ $ctx->customer }}</td>
    <td style="padding:5px 6px; font-size:9px; color:#334155">{{ $categories[$ctx->category] ?? $ctx->category }}</td>
    <td style="padding:5px 6px; font-size:9px; color:#334155; text-align:right; font-variant-numeric:tabular-nums">
        {{ $ctx->currency($ctx->amount) }}
    </td>
    <td style="padding:5px 6px; font-size:9px; color:#64748b">{{ $ctx->date($ctx->ordered_at) }}</td>
    <td style="padding:5px 6px; font-size:9px; color:#334155">{{ $statuses[$ctx->status] ?? $ctx->status }}</td>
</tr>
