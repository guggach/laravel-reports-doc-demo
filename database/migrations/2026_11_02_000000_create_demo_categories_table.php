<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('demo_categories', function (Blueprint $table): void {
            $table->id();
            $table->string('category')->unique();
            $table->json('translations');
            $table->decimal('target', 10, 2);
        });

        DB::table('demo_categories')->insert([
            [
                'category' => 'Miete',
                'translations' => json_encode(['de' => 'Miete', 'en' => 'Rent'], JSON_THROW_ON_ERROR),
                'target' => 15000.00,
            ],
            [
                'category' => 'Service',
                'translations' => json_encode(['de' => 'Service', 'en' => 'Service'], JSON_THROW_ON_ERROR),
                'target' => 6000.00,
            ],
            [
                'category' => 'Verkauf',
                'translations' => json_encode(['de' => 'Verkauf', 'en' => 'Sale'], JSON_THROW_ON_ERROR),
                'target' => 30000.00,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('demo_categories');
    }
};
