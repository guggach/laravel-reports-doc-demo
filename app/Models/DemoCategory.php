<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Demo category with translated names. This mimics the lazy translated
 * attribute of spatie/laravel-translatable: the accessor reads the ambient
 * app locale, which the reports engine sets during a run.
 */
final class DemoCategory extends Model
{
    protected $table = 'demo_categories';

    public $timestamps = false;

    protected $guarded = [];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'translations' => 'array',
            'target' => 'decimal:2',
        ];
    }

    public function getNameAttribute(): string
    {
        $translations = $this->translations;
        $locale = app()->getLocale();

        return $translations[$locale] ?? $translations['en'] ?? '';
    }
}
