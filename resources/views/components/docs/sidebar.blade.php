@php($current = request()->route('page'))

<nav class="space-y-1">
    <p class="px-3 pb-1 text-xs font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">
        {{ __('site.docs.on_this_page') }}
    </p>

    @foreach (config('docs.pages') as $slug => $page)
        <a
            href="{{ route('docs.show', ['page' => $slug]) }}"
            @class([
                'block rounded-lg px-3 py-2 text-sm font-medium transition',
                'bg-teal-50 text-teal-700 dark:bg-teal-500/10 dark:text-teal-300' => $current === $slug,
                'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-white/5 dark:hover:text-white' => $current !== $slug,
            ])
        >{{ __($page['title']) }}</a>
    @endforeach
</nav>
