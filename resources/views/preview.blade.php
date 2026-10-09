<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vorschau · Preisliste</title>
</head>
<body style="margin:0; background:#e5e7eb;">
    <x-reports::frame
        url="/report/price-list"
        :page-setup="$pageSetup"
        title="Preisliste 2026"
    />
</body>
</html>
