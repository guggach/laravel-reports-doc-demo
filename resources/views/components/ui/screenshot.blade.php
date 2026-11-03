<div {{ $attributes->merge(['class' => 'overflow-hidden rounded-xl border border-slate-200 bg-slate-100 shadow-sm dark:border-white/10 dark:bg-slate-900']) }}>
    <div class="flex items-center gap-3 border-b border-slate-200 bg-white px-3 py-2 dark:border-white/10 dark:bg-slate-900">
        <div class="flex gap-1.5">
            <span class="h-3 w-3 rounded-full bg-rose-400"></span>
            <span class="h-3 w-3 rounded-full bg-amber-400"></span>
            <span class="h-3 w-3 rounded-full bg-emerald-400"></span>
        </div>

        <div class="mx-auto hidden max-w-[55%] flex-1 truncate rounded-md bg-slate-100 px-3 py-1 text-center font-mono text-[11px] text-slate-400 sm:block dark:bg-white/5">
            {{ parse_url($href, PHP_URL_PATH) }}
        </div>

        <div class="flex items-center gap-1.5">
            <a
                href="{{ $href }}"
                target="_blank"
                rel="noopener"
                class="rounded-md px-2 py-1 text-xs font-medium text-slate-500 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-white/10 dark:hover:text-white"
            >{{ __('site.nav.demo') }}</a>

            @if ($pdf)
                <a
                    href="{{ $pdf }}"
                    class="rounded-md px-2 py-1 text-xs font-medium text-slate-500 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-white/10 dark:hover:text-white"
                >{{ __('site.actions.pdf') }}</a>
            @endif
        </div>
    </div>

    @if ($exists)
        <a
            href="{{ $href }}"
            target="_blank"
            rel="noopener"
            class="block overflow-hidden"
            style="height: {{ $height }}"
            aria-label="{{ $title ?? __('site.actions.preview') }}"
        >
            <img
                src="{{ asset($src) }}"
                alt="{{ $title ?? __('site.actions.preview') }}"
                loading="lazy"
                decoding="async"
                class="h-full w-full object-cover object-top transition duration-500 hover:scale-[1.015]"
            >
        </a>
    @else
        <div class="grid place-items-center px-6 text-center" style="height: {{ $height }}">
            <div>
                <p class="text-xs font-medium text-slate-400 dark:text-slate-500">
                    {{ __('site.actions.preview') }}
                </p>
                <code class="mt-2 inline-block rounded-md bg-white px-2 py-1 font-mono text-[11px] text-slate-400 dark:bg-white/5">
                    php artisan demo:screenshots
                </code>
            </div>
        </div>
    @endif
</div>
