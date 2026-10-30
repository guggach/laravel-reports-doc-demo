<?php

declare(strict_types=1);

namespace App\Support;

use Tempest\Highlight\Highlighter;

/**
 * Reads real source files from the playground and renders them as highlighted
 * HTML. This keeps the documentation site in sync with the code that actually
 * produces the reports: no copy-pasted snippets that silently drift.
 */
final class CodeSample
{
    /**
     * Extension (or trailing file name) to highlight language map.
     *
     * @var array<string, string>
     */
    private const LANGUAGES = [
        'blade.php' => 'blade',
        'php' => 'php',
        'css' => 'css',
        'js' => 'javascript',
        'json' => 'json',
        'sql' => 'sql',
        'html' => 'html',
        'md' => 'markdown',
    ];

    private readonly Highlighter $highlighter;

    public function __construct(?Highlighter $highlighter = null)
    {
        $this->highlighter = $highlighter ?? new Highlighter;
    }

    /**
     * Build a single tab for the code viewer from a file on disk.
     *
     * @return array{label: string, path: string, lang: string, code: string, html: string}
     */
    public function tab(string $path, ?string $label = null, ?string $lang = null): array
    {
        $language = $lang ?? $this->language($path);
        $code = $this->read($path);

        return $this->snippet($code, $language, $label ?? $this->label($path), $path);
    }

    /**
     * Build a tab from raw code (for short snippets written inline).
     *
     * @return array{label: string, path: string, lang: string, code: string, html: string}
     */
    public function snippet(string $code, string $lang = 'php', string $label = 'snippet', string $path = ''): array
    {
        return [
            'label' => $label,
            'path' => $path,
            'lang' => $lang,
            'code' => $code,
            'html' => $this->highlight($code, $lang),
        ];
    }

    public function read(string $path): string
    {
        $absolute = base_path($path);

        if (! is_file($absolute)) {
            return "// File not found: {$path}";
        }

        return (string) file_get_contents($absolute);
    }

    public function highlight(string $code, string $lang = 'php'): string
    {
        return $this->highlighter->parse($code, $lang);
    }

    public function language(string $path): string
    {
        $name = strtolower($path);

        foreach (self::LANGUAGES as $needle => $language) {
            if (str_ends_with($name, '.'.$needle)) {
                return $language;
            }
        }

        return 'text';
    }

    /**
     * A short, readable tab label. When a report module is given, the label is
     * relative to it (e.g. "views/row.blade.php" instead of the absolute path).
     */
    public function label(string $path, ?string $module = null): string
    {
        if ($module !== null) {
            $prefix = "app/Reports/{$module}/";

            if (str_starts_with($path, $prefix)) {
                return substr($path, strlen($prefix));
            }
        }

        return basename($path);
    }
}
