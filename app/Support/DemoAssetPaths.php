<?php

declare(strict_types=1);

namespace App\Support;

use InvalidArgumentException;

/**
 * Single source of truth for the generated demo assets:
 *
 *   public/images/examples/{key}.webp   landing page screenshots
 *   storage/app/demo-pdfs/{key}.{locale}.pdf   prebuilt PDF downloads
 *
 * The report list comes from config/docs.php, so adding an example there
 * automatically includes it in the generation commands.
 */
final class DemoAssetPaths
{
    /** Public-relative directory of the landing page screenshots. */
    public const SCREENSHOTS = 'images/examples';

    /** Storage-relative directory of the prebuilt PDFs. */
    public const PDFS = 'demo-pdfs';

    /**
     * @return list<string>
     */
    public static function reportKeys(): array
    {
        $keys = [];

        foreach (config('docs.examples', []) as $example) {
            if (is_array($example) && is_string($example['key'] ?? null)) {
                $keys[] = self::normalize($example['key']);
            }
        }

        return $keys;
    }

    /**
     * Accept hyphenated URL segments (price-list) for snake_case keys (price_list).
     */
    public static function normalize(string $key): string
    {
        return str_replace('-', '_', $key);
    }

    public static function hasReport(string $key): bool
    {
        return in_array(self::normalize($key), self::reportKeys(), true);
    }

    /**
     * Resolve the `--only` option (comma separated report keys).
     *
     * @return list<string>
     */
    public static function resolveKeys(?string $only = null): array
    {
        $all = self::reportKeys();

        if ($only === null || mb_trim($only) === '') {
            return $all;
        }

        $requested = array_filter(array_map('trim', explode(',', $only)));
        $resolved = [];

        foreach ($requested as $key) {
            $normalized = self::normalize($key);

            if (! in_array($normalized, $all, true)) {
                throw new InvalidArgumentException(
                    "Unknown report [{$key}]. Available: ".implode(', ', $all)
                );
            }

            $resolved[] = $normalized;
        }

        return array_values(array_unique($resolved));
    }

    /**
     * @return list<string>
     */
    public static function locales(): array
    {
        $locales = config('localizer.supported_locales', [config('app.locale', 'en')]);
        $locales = is_array($locales) ? $locales : [$locales];

        return array_values(array_filter($locales, 'is_string'));
    }

    /**
     * @return list<string>
     */
    public static function resolveLocales(?string $locale = null): array
    {
        if ($locale === null || mb_trim($locale) === '') {
            return self::locales();
        }

        return [mb_trim($locale)];
    }

    public static function screenshotPath(string $key): string
    {
        return public_path(self::screenshotSource($key));
    }

    /**
     * Public-relative path, e.g. "images/examples/price_list.webp".
     */
    public static function screenshotSource(string $key): string
    {
        return self::SCREENSHOTS.'/'.self::normalize($key).'.webp';
    }

    public static function screenshotExists(string $key): bool
    {
        return is_file(self::screenshotPath($key));
    }

    public static function pdfPath(string $key, string $locale): string
    {
        return storage_path('app/'.self::PDFS.'/'.self::normalize($key).'.'.$locale.'.pdf');
    }

    public static function pdfExists(string $key, string $locale): bool
    {
        return is_file(self::pdfPath($key, $locale));
    }
}
