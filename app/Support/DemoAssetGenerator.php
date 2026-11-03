<?php

declare(strict_types=1);

namespace App\Support;

use Guggach\Reports\Reports;
use HeadlessChromium\BrowserFactory;
use HeadlessChromium\Clip;
use HeadlessChromium\Page;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use RuntimeException;
use Throwable;

/**
 * Generates the static demo assets (landing page screenshots and prebuilt
 * PDFs) from the running application.
 *
 * Both need an HTTP endpoint: the report HTML references assets such as the
 * Swiss QR payment slip via asset(), so Chromium must be able to fetch them.
 * The commands therefore require a reachable base URL (APP_URL by default).
 *
 * In production the app container serves itself, which is why the deploy step
 * runs `demo:assets --url=http://127.0.0.1`: that bypasses the public Caddy
 * (including a possible basic_auth gate) without breaking asset URLs.
 */
final readonly class DemoAssetGenerator
{
    public function __construct(private Reports $reports) {}

    /**
     * Normalise the base URL and point the URL generator at it, so asset()
     * inside the in-process PDF rendering resolves against the same host.
     */
    public function baseUrl(?string $url = null): string
    {
        $url = is_string($url) && mb_trim($url) !== '' ? mb_trim($url) : (string) config('app.url');

        if ($url === '') {
            throw new RuntimeException(
                'No base URL: set APP_URL in your .env file or pass --url=http://localhost:8000.'
            );
        }

        $url = rtrim($url, '/');

        URL::forceRootUrl($url);

        return $url;
    }

    public function assertReachable(string $baseUrl): void
    {
        try {
            $response = Http::timeout(10)->get($baseUrl.'/up');
        } catch (Throwable $exception) {
            throw new RuntimeException(
                "The app is not reachable at [{$baseUrl}]. ".
                'Start `php artisan serve` in a second terminal or pass --url with a running instance.',
                0,
                $exception,
            );
        }

        if ($response->failed()) {
            throw new RuntimeException("The app answered at [{$baseUrl}] with HTTP {$response->status()}.");
        }
    }

    /**
     * @param  list<string>  $keys
     * @param  callable(string): void|null  $progress
     * @return list<string> written files
     */
    public function screenshots(string $baseUrl, array $keys, string $locale, ?callable $progress = null): array
    {
        $binary = ChromiumBinary::path();

        if ($binary === null) {
            throw new RuntimeException(
                'No Chromium found. Set LARAVEL_PDF_CHROME_BINARY or run `npx playwright install chromium`.'
            );
        }

        $factory = new BrowserFactory($binary);
        $browser = $factory->createBrowser([
            'noSandbox' => true,
            'customFlags' => ['--disable-dev-shm-usage', '--hide-scrollbars'],
        ]);

        $written = [];

        try {
            foreach ($keys as $key) {
                if ($progress !== null) {
                    $progress($key);
                }

                $path = DemoAssetPaths::screenshotPath($key);
                $this->ensureDirectory(dirname($path));

                $page = $browser->createPage();

                try {
                    // A4 portrait is 210mm ≈ 794 CSS px at 96 dpi. The paper
                    // surface is fixed in mm, so the viewport only needs to be
                    // wide enough to avoid a horizontal scrollbar.
                    ['width' => $widthMm, 'height' => $heightMm] = $this->reports->pageSetup($key)->dimensions();

                    $viewport = (int) ceil($widthMm * 96 / 25.4);
                    $paperHeight = (int) ceil($heightMm * 96 / 25.4);

                    $page->setDeviceMetricsOverride([
                        'width' => $viewport,
                        'height' => 1200,
                        'deviceScaleFactor' => 2,
                        'mobile' => false,
                    ]);

                    $page->navigate($this->reportUrl($baseUrl, $key, $locale))
                        ->waitForNavigation(timeout: 30000);

                    // Let webfonts and late layout settle before capturing.
                    usleep(250_000);

                    // Strict reports draw one .guggach-page per page; flow
                    // reports use a single endless surface. Capture exactly one
                    // page so the landing page shows a readable crop and the
                    // images stay small.
                    $rect = $this->surfaceRect($page);

                    if ($rect === null) {
                        throw new RuntimeException("Could not find the report surface for [{$key}].");
                    }

                    $shotWidth = (int) ceil($rect['width']);
                    $shotHeight = min((int) ceil($rect['height']), $paperHeight);

                    $page->setDeviceMetricsOverride([
                        'width' => $shotWidth + 2,
                        'height' => min($shotHeight + 2, 4000),
                        'deviceScaleFactor' => 2,
                        'mobile' => false,
                    ]);

                    usleep(100_000);

                    $rect = $this->surfaceRect($page) ?? $rect;

                    $page->screenshot([
                        'format' => 'webp',
                        'quality' => 82,
                        'captureBeyondViewport' => true,
                        'clip' => new Clip(
                            $rect['x'],
                            $rect['y'],
                            $shotWidth,
                            $shotHeight,
                        ),
                    ])->saveToFile($path);

                    $written[] = $path;
                } finally {
                    $page->close();
                }
            }
        } finally {
            $browser->close();
        }

        return $written;
    }

    /**
     * @param  list<string>  $keys
     * @param  list<string>  $locales
     * @param  callable(string, string): void|null  $progress
     * @return list<string> written files
     */
    public function pdfs(string $baseUrl, array $keys, array $locales, ?callable $progress = null): array
    {
        URL::forceRootUrl($baseUrl);

        $written = [];

        foreach ($keys as $key) {
            foreach ($locales as $locale) {
                if ($progress !== null) {
                    $progress($key, $locale);
                }

                $path = DemoAssetPaths::pdfPath($key, $locale);
                $this->ensureDirectory(dirname($path));

                $this->reports->pdf($key, locale: $locale)->save($path);

                $written[] = $path;
            }
        }

        return $written;
    }

    /**
     * The on-screen box of one report page, in CSS pixels.
     *
     * getClip() from the DOM API reports a scaled box for this page setup, so
     * the rect is measured in the page itself instead.
     *
     * @return array{x: float, y: float, width: float, height: float}|null
     */
    private function surfaceRect(Page $page): ?array
    {
        $rect = $page->evaluate(<<<'JS'
            (function () {
                const element = document.querySelector('.guggach-page')
                    ?? document.querySelector('.report-surface');

                if (!element) {
                    return null;
                }

                const rect = element.getBoundingClientRect();

                return { x: rect.x, y: rect.y, width: rect.width, height: rect.height };
            })()
            JS)->getReturnValue();

        if (! is_array($rect)) {
            return null;
        }

        return [
            'x' => (float) $rect['x'],
            'y' => (float) $rect['y'],
            'width' => (float) $rect['width'],
            'height' => (float) $rect['height'],
        ];
    }

    private function reportUrl(string $baseUrl, string $key, string $locale): string
    {
        $url = $baseUrl.'/reports/internal/'.rawurlencode($key);

        if ($locale !== '') {
            $url .= '?locale='.rawurlencode($locale);
        }

        return $url;
    }

    private function ensureDirectory(string $directory): void
    {
        if (! is_dir($directory) && ! @mkdir($directory, 0o775, true) && ! is_dir($directory)) {
            throw new RuntimeException("Could not create directory [{$directory}].");
        }
    }
}
