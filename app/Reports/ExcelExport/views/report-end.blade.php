    </tbody>
</table>

<div style="display:flex; justify-content:flex-end; align-items:baseline; gap:10mm; margin-top:10px; padding-top:8px; border-top:2px solid #0f172a">
    <span style="font-size:10px; font-weight:700; color:#0f172a">{{ __('excel_export::report.total') }}</span>
    <span style="font-size:12px; font-weight:700; color:#0f172a; font-variant-numeric:tabular-nums">
        {{ $ctx->currency((float) $ctx->aggregates['total']) }}
    </span>
</div>
