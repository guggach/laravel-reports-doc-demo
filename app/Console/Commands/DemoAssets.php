<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Runs both demo asset generators against the same instance. This is the
 * command the deploy pipeline calls, e.g.
 *
 *   docker compose exec -T docs php artisan demo:assets --url=http://127.0.0.1
 */
final class DemoAssets extends Command
{
    protected $signature = 'demo:assets
        {--url= : Base URL of the running app (defaults to APP_URL)}
        {--locale= : Only render this locale (defaults to all supported locales)}
        {--only= : Comma separated report keys}';

    protected $description = 'Generate the landing page screenshots and the prebuilt PDFs';

    public function handle(): int
    {
        $options = array_filter([
            '--url' => $this->option('url'),
            '--only' => $this->option('only'),
            '--locale' => $this->option('locale'),
        ], fn (mixed $value): bool => $value !== null && $value !== '');

        $screenshots = $this->call('demo:screenshots', $options);

        if ($screenshots !== self::SUCCESS) {
            return $screenshots;
        }

        return $this->call('demo:pdfs', $options);
    }
}
