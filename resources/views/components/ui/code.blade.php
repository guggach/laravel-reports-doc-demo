@php($codes = array_map(fn (array $tab): string => $tab['code'], $tabs))

<div
    {{ $attributes->merge(['class' => 'overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm dark:border-white/10 dark:bg-slate-900']) }}
    x-data="{
        tab: 0,
        copied: false,
        codes: @js($codes),
        copy() {
            const text = this.codes[this.tab] ?? '';
            navigator.clipboard?.writeText(text).then(() => {
                this.copied = true;
                window.setTimeout(() => { this.copied = false; }, 1600);
            });
        },
    }"
>
    <div class="flex items-center gap-2 border-b border-slate-200 bg-slate-50/70 px-3 py-2 dark:border-white/10 dark:bg-white/5">
        <div class="flex min-w-0 flex-1 items-center gap-1 overflow-x-auto">
            @foreach ($tabs as $i => $tab)
                <button
                    type="button"
                    @click="tab = {{ $i }}"
                    class="shrink-0 rounded-md px-2.5 py-1 font-mono text-xs font-medium transition"
                    :class="tab === {{ $i }}
                        ? 'bg-white text-slate-900 shadow-sm ring-1 ring-slate-200 dark:bg-white/10 dark:text-white dark:ring-white/10'
                        : 'text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white'"
                >{{ $tab['label'] }}</button>
            @endforeach
        </div>

        <button
            type="button"
            @click="copy()"
            class="shrink-0 rounded-md p-1.5 text-slate-400 transition hover:bg-slate-200/70 hover:text-slate-700 dark:hover:bg-white/10 dark:hover:text-white"
            :title="copied ? @js(__('site.actions.copied')) : @js(__('site.actions.copy'))"
            :aria-label="copied ? @js(__('site.actions.copied')) : @js(__('site.actions.copy'))"
        >
            <svg x-show="! copied" x-cloak class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                <rect x="9" y="9" width="11" height="11" rx="2" />
                <path d="M5 15V5a2 2 0 0 1 2-2h10" />
            </svg>
            <svg x-show="copied" x-cloak class="h-4 w-4 text-emerald-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="m5 13 4 4L19 7" />
            </svg>
        </button>
    </div>

    @foreach ($tabs as $i => $tab)
        <div x-show="tab === {{ $i }}" x-cloak>
            <pre class="overflow-auto bg-white p-4 font-mono text-[13px] leading-6 dark:bg-slate-900" style="max-height: {{ $maxHeight }}"><code class="hl block" data-lang="{{ $tab['lang'] }}">{!! $tab['html'] !!}</code></pre>
        </div>
    @endforeach

    @if ($caption)
        <p class="border-t border-slate-200 px-4 py-2 text-xs text-slate-500 dark:border-white/10 dark:text-slate-400">{{ $caption }}</p>
    @endif
</div>
