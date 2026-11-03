<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Support\DemoAssetGenerator;
use App\Support\DemoAssetPaths;
use Illuminate\Console\Command;

final class DemoScreenshots extends Command
{
    protected $signature = 'demo:screenshots
        {--url= : Base URL of the running app (defaults to APP_URL)}
        {--locale= : Report language (defaults to the app locale)}
        {--only= : Comma separated report keys}';

    protected $description = 'Generate the landing page screenshots from the real reports';

    public function handle(DemoAssetGenerator $generator): int
    {
        $url = $generator->baseUrl($this->option('url'));
        $generator->assertReachable($url);

        $locale = (string) ($this->option('locale') ?: config('app.locale', 'en'));
        $keys = DemoAssetPaths::resolveKeys($this->option('only'));

        $this->components->info("Screenshots from {$url} (locale: {$locale})");

        $written = $generator->screenshots(
            $url,
            $keys,
            $locale,
            fn (string $key) => $this->components->task($key),
        );

        $this->components->info(count($written).' screenshot(s) written to '.DemoAssetPaths::SCREENSHOTS);

        return self::SUCCESS;
    }
}
