<div {{ $attributes->merge(['class' => 'overflow-hidden rounded-xl border border-slate-200 bg-slate-100 shadow-sm dark:border-white/10 dark:bg-slate-900']) }}>
    <div class="flex items-center gap-3 border-b border-slate-200 bg-white px-3 py-2 dark:border-white/10 dark:bg-slate-900">
        <div class="flex gap-1.5">
            <span class="h-3 w-3 rounded-full bg-rose-400"></span>
            <span class="h-3 w-3 rounded-full bg-amber-400"></span>
            <span class="h-3 w-3 rounded-full bg-emerald-400"></span>
        </div>

        <div class="mx-auto hidden max-w-[55%] flex-1 truncate rounded-md bg-slate-100 px-3 py-1 text-center font-mono text-[11px] text-slate-400 sm:block dark:bg-white/5">
            {{ $src }}
        </div>

        <div class="flex items-center gap-1.5">
            @if ($open)
                <a
                    href="{{ $open }}"
                    target="_blank"
                    rel="noopener"
                    class="rounded-md px-2 py-1 text-xs font-medium text-slate-500 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-white/10 dark:hover:text-white"
                >{{ __('site.actions.open_full') }}</a>
            @endif

            @if ($pdf)
                <a
                    href="{{ $pdf }}"
                    class="rounded-md px-2 py-1 text-xs font-medium text-slate-500 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-white/10 dark:hover:text-white"
                >{{ __('site.actions.pdf') }}</a>
            @endif

            @if ($excel ?? null)
                <a
                    href="{{ $excel }}"
                    class="rounded-md px-2 py-1 text-xs font-medium text-slate-500 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-white/10 dark:hover:text-white"
                >{{ __('site.actions.excel') }}</a>
            @endif
        </div>
    </div>

    <iframe
        src="{{ $src }}"
        title="{{ $title ?? __('site.actions.preview') }}"
        loading="lazy"
        class="block w-full border-0 bg-white"
        style="height: {{ $height }}"
    ></iframe>
</div>
