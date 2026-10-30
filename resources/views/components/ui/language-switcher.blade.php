@if (Route::isLocalized())
    <div class="flex items-center gap-0.5 rounded-full border border-slate-200 p-0.5 text-xs font-semibold dark:border-white/10">
        @foreach (config('localizer.supported_locales') as $locale)
            @php($active = app()->getLocale() === $locale)
            <a
                href="{{ Route::localizedSwitcherUrl($locale) }}"
                hreflang="{{ $locale }}"
                @class([
                    'rounded-full px-2 py-1 transition',
                    'bg-slate-900 text-white dark:bg-white dark:text-slate-900' => $active,
                    'text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white' => ! $active,
                ])
            >{{ strtoupper($locale) }}</a>
        @endforeach
    </div>
@endif
