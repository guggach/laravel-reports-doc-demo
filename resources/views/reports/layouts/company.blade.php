<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="page-size" content="{{ $pageSetup->size }}-{{ $pageSetup->orientation }}">
    <title>{{ $title ?? 'Report' }}</title>
    <style>
        @page {
            size: {{ $pageSetup->size }} {{ $pageSetup->orientation }};
            margin: {{ $pageSetup->margins['top'] }}mm {{ $pageSetup->margins['right'] }}mm {{ $pageSetup->margins['bottom'] }}mm {{ $pageSetup->margins['left'] }}mm;
        }
        body { font-family: sans-serif; color: #1f2937; margin: 0; }
        .brand { display: flex; justify-content: space-between; align-items: baseline; border-bottom: 3px solid #0f766e; padding-bottom: 8px; margin-bottom: 18px; }
        .brand .name { font-size: 22px; font-weight: 700; color: #0f766e; }
        .brand .meta { color: #6b7280; font-size: 12px; }
        .footer { border-top: 1px solid #d1d5db; margin-top: 28px; padding-top: 8px; font-size: 11px; color: #6b7280; display: flex; justify-content: space-between; }
    </style>
</head>
<body data-layout="company">
    <x-reports::surface :page-setup="$pageSetup">
        <header class="brand">
            <span class="name">Acme AG</span>
            <span class="meta">{{ $meta['subtitle'] ?? 'Report' }} · {{ now()->format('d.m.Y') }}</span>
        </header>

        <main>
            {!! $content ?? '' !!}
        </main>

        <footer class="footer">
            <span>Acme AG · Beispielstrasse 1 · 8000 Zürich</span>
            <span>{{ $title }}</span>
        </footer>
    </x-reports::surface>
</body>
</html>
