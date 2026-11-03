<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Response;

/**
 * The demo exposes two crawl surfaces:
 *
 *  - the documentation pages (indexable, listed in the sitemap)
 *  - the example reports (usable, but marked noindex by the NoIndex middleware)
 *
 * robots.txt is generated instead of shipped as a static file so the sitemap
 * URL always matches APP_URL / the current host.
 */
final class SeoController extends Controller
{
    public function robots(): Response
    {
        $lines = [
            'User-agent: *',
            'Disallow:',
            '',
            'Sitemap: '.url('/sitemap.xml'),
        ];

        return response(implode("\n", $lines)."\n", 200, [
            'Content-Type' => 'text/plain; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    public function sitemap(): Response
    {
        $entries = '';

        foreach ($this->urls() as $url) {
            $entries .= '    <url>'."\n"
                .'        <loc>'.e($url).'</loc>'."\n"
                .'    </url>'."\n";
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n"
            .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n"
            .$entries
            .'</urlset>'."\n";

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    /**
     * @return list<string>
     */
    private function urls(): array
    {
        $paths = ['/', '/docs'];

        foreach (array_keys(config('docs.pages', [])) as $page) {
            $paths[] = '/docs/'.$page;
        }

        $urls = [];

        foreach ($paths as $path) {
            foreach ($this->locales() as $locale) {
                $urls[] = $this->localizedUrl($path, $locale);
            }
        }

        return array_values(array_unique($urls));
    }

    /**
     * @return list<string>
     */
    private function locales(): array
    {
        $locales = config('localizer.supported_locales', [config('app.locale', 'en')]);

        return is_array($locales) ? array_values(array_filter($locales, 'is_string')) : ['en'];
    }

    private function localizedUrl(string $path, string $locale): string
    {
        $path = '/'.mb_ltrim($path, '/');

        if ($locale === (string) config('app.locale')) {
            return url($path);
        }

        return url('/'.$locale.($path === '/' ? '' : $path));
    }
}
