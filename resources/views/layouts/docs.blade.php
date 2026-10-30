<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', __('site.meta.title'))</title>
    <meta name="description" content="@yield('description', __('site.meta.description'))">

    @if (Route::isLocalized())
        @foreach (config('localizer.supported_locales') as $locale)
            <link rel="alternate" hreflang="{{ $locale }}" href="{{ Route::localizedUrl($locale) }}">
        @endforeach
    @endif

    {{-- Set the theme before first paint to avoid a flash. --}}
    <script>
        (function () {
            try {
                const stored = localStorage.getItem('theme');
                const dark = stored ? stored === 'dark' : window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (dark) document.documentElement.classList.add('dark');
            } catch (e) {}
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white font-sans text-slate-900 antialiased selection:bg-teal-200 selection:text-teal-900 dark:bg-slate-950 dark:text-slate-100">
    <div class="flex min-h-screen flex-col">
        {{-- Nav --}}
        <header class="sticky top-0 z-40 border-b border-slate-200/70 bg-white/85 backdrop-blur dark:border-white/10 dark:bg-slate-950/85" x-data="{ open: false }">
            <div class="mx-auto flex h-16 max-w-7xl items-center gap-3 px-4 sm:px-6 lg:px-8">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 font-semibold tracking-tight">
                    <span class="grid h-8 w-8 place-items-center rounded-lg bg-teal-600 text-white">
                        <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <rect x="4" y="3" width="16" height="18" rx="2" />
                            <path d="M8 8h8M8 12h8M8 16h5" />
                        </svg>
                    </span>
                    <span>Laravel Reports</span>
                </a>

                <nav class="ml-4 hidden items-center gap-6 text-sm text-slate-600 md:flex dark:text-slate-300">
                    <a href="{{ route('home') }}#features" class="transition hover:text-slate-900 dark:hover:text-white">{{ __('site.nav.features') }}</a>
                    <a
                        href="{{ route('examples.index') }}"
                        @class([
                            'transition hover:text-slate-900 dark:hover:text-white',
                            'font-semibold text-slate-900 dark:text-white' => request()->routeIs('examples.*'),
                        ])
                    >{{ __('site.nav.examples') }}</a>
                    <a
                        href="{{ route('docs.index') }}"
                        @class([
                            'transition hover:text-slate-900 dark:hover:text-white',
                            'font-semibold text-slate-900 dark:text-white' => request()->routeIs('docs.*'),
                        ])
                    >{{ __('site.nav.docs') }}</a>
                </nav>

                <div class="ml-auto flex items-center gap-2">
                    <x-ui.language-switcher />
                    <x-ui.theme-toggle />

                    <a
                        href="https://github.com/guggach/laravel-reports"
                        target="_blank"
                        rel="noopener"
                        class="hidden rounded-lg p-2 text-slate-500 transition hover:bg-slate-100 hover:text-slate-900 sm:block dark:text-slate-400 dark:hover:bg-white/10 dark:hover:text-white"
                        aria-label="GitHub"
                    >
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 .5C5.7.5.5 5.7.5 12c0 5 3.3 9.3 7.8 10.8.6.1.8-.3.8-.6v-2c-3.2.7-3.8-1.4-3.8-1.4-.5-1.3-1.3-1.7-1.3-1.7-1-.7.1-.7.1-.7 1.1.1 1.7 1.2 1.7 1.2 1 1.7 2.7 1.2 3.3.9.1-.7.4-1.2.7-1.5-2.5-.3-5.2-1.3-5.2-5.6 0-1.2.4-2.2 1.2-3-.1-.3-.5-1.5.1-3.1 0 0 .9-.3 3.1 1.2a10.8 10.8 0 0 1 5.6 0C17.3 4.7 18.2 5 18.2 5c.6 1.6.2 2.8.1 3.1.7.8 1.2 1.8 1.2 3 0 4.4-2.7 5.3-5.2 5.6.4.4.8 1.1.8 2.2v3.3c0 .3.2.7.8.6A11.5 11.5 0 0 0 23.5 12C23.5 5.7 18.3.5 12 .5Z" />
                        </svg>
                    </a>

                    <button
                        type="button"
                        @click="open = ! open"
                        class="rounded-lg p-2 text-slate-500 transition hover:bg-slate-100 hover:text-slate-900 md:hidden dark:text-slate-400 dark:hover:bg-white/10 dark:hover:text-white"
                        :aria-label="@js(__('site.nav.menu'))"
                    >
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M4 7h16M4 12h16M4 17h16" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Mobile nav --}}
            <div class="md:hidden">
                <div
                    x-cloak
                    x-show="open"
                    class="border-t border-slate-200 bg-white px-4 py-3 dark:border-white/10 dark:bg-slate-950"
                >
                    <a href="{{ route('home') }}#features" class="block rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-white/5">{{ __('site.nav.features') }}</a>
                    <a href="{{ route('examples.index') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-white/5">{{ __('site.nav.examples') }}</a>
                    <a href="{{ route('docs.index') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-white/5">{{ __('site.nav.docs') }}</a>
                </div>
            </div>
        </header>

        {{-- Content --}}
        <div class="flex-1">
            @hasSection('sidebar')
                <div class="mx-auto grid max-w-7xl gap-10 px-4 py-10 sm:px-6 lg:grid-cols-[15rem_minmax(0,1fr)] lg:py-14 lg:px-8">
                    <aside class="lg:sticky lg:top-24 lg:self-start">
                        @yield('sidebar')
                    </aside>
                    <main class="min-w-0">
                        @yield('content')
                    </main>
                </div>
            @else
                <main>
                    @yield('content')
                </main>
            @endif
        </div>

        {{-- Footer --}}
        <footer class="border-t border-slate-200 bg-slate-50 dark:border-white/10 dark:bg-slate-900/40">
            <div class="mx-auto flex max-w-7xl flex-col gap-6 px-4 py-10 sm:px-6 md:flex-row md:items-center md:justify-between lg:px-8">
                <div>
                    <p class="font-semibold tracking-tight">Laravel Reports</p>
                    <p class="mt-1 max-w-sm text-sm text-slate-500 dark:text-slate-400">{{ __('site.footer.tagline') }}</p>
                </div>

                <div class="flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-slate-500 dark:text-slate-400">
                    <a href="{{ route('docs.index') }}" class="transition hover:text-slate-900 dark:hover:text-white">{{ __('site.footer.docs') }}</a>
                    <a href="{{ route('examples.index') }}" class="transition hover:text-slate-900 dark:hover:text-white">{{ __('site.footer.examples') }}</a>
                    <a href="https://github.com/guggach/laravel-reports" target="_blank" rel="noopener" class="transition hover:text-slate-900 dark:hover:text-white">GitHub</a>
                </div>
            </div>

            <div class="border-t border-slate-200 dark:border-white/10">
                <div class="mx-auto max-w-7xl px-4 py-4 text-xs text-slate-400 sm:px-6 lg:px-8">
                    {{ __('site.footer.rights') }} · {{ __('site.footer.built') }}
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
