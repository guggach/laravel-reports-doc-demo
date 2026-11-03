<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Support\DemoAssetGenerator;
use App\Support\DemoAssetPaths;
use Illuminate\Console\Command;

final class DemoPdfs extends Command
{
    protected $signature = 'demo:pdfs
        {--url= : Base URL of the running app (defaults to APP_URL)}
        {--locale= : Only render this locale (defaults to all supported locales)}
        {--only= : Comma separated report keys}';

    protected $description = 'Pre-render the example PDFs served by the demo';

    public function handle(DemoAssetGenerator $generator): int
    {
        $url = $generator->baseUrl($this->option('url'));
        $generator->assertReachable($url);

        $keys = DemoAssetPaths::resolveKeys($this->option('only'));
        $locales = DemoAssetPaths::resolveLocales($this->option('locale'));

        $this->components->info("PDFs from {$url} (locales: ".implode(', ', $locales).')');

        $written = $generator->pdfs(
            $url,
            $keys,
            $locales,
            fn (string $key, string $locale) => $this->components->task("{$key} ({$locale})"),
        );

        $this->components->info(count($written).' PDF(s) written to storage/app/'.DemoAssetPaths::PDFS);

        return self::SUCCESS;
    }
}
