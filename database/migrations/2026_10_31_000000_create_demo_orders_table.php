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
        Schema::create('demo_orders', function (Blueprint $table): void {
            $table->id();
            $table->string('order_number')->unique();
            $table->string('customer');
            $table->string('category');
            $table->decimal('amount', 10, 2);
            $table->date('ordered_at');
            $table->string('status');
        });

        DB::table('demo_orders')->insert([
            ['order_number' => 'AU-2026-1001', 'customer' => 'Alpine Studio GmbH', 'category' => 'Miete', 'amount' => 2400.00, 'ordered_at' => '2026-09-18', 'status' => 'bezahlt'],
            ['order_number' => 'AU-2026-1002', 'customer' => 'BA Contemporary Dance', 'category' => 'Miete', 'amount' => 2133.35, 'ordered_at' => '2026-09-18', 'status' => 'offen'],
            ['order_number' => 'AU-2026-1003', 'customer' => 'Müller Informatik AG', 'category' => 'Service', 'amount' => 860.00, 'ordered_at' => '2026-09-22', 'status' => 'bezahlt'],
            ['order_number' => 'AU-2026-1004', 'customer' => 'Seeblick Immobilien', 'category' => 'Miete', 'amount' => 3200.00, 'ordered_at' => '2026-09-28', 'status' => 'offen'],
            ['order_number' => 'AU-2026-1005', 'customer' => 'Nordlicht GmbH', 'category' => 'Verkauf', 'amount' => 12500.00, 'ordered_at' => '2026-10-02', 'status' => 'bezahlt'],
            ['order_number' => 'AU-2026-1006', 'customer' => 'Kunsthaus West', 'category' => 'Service', 'amount' => 1450.00, 'ordered_at' => '2026-10-05', 'status' => 'offen'],
            ['order_number' => 'AU-2026-1007', 'customer' => 'Rheinblick AG', 'category' => 'Miete', 'amount' => 1800.00, 'ordered_at' => '2026-10-08', 'status' => 'bezahlt'],
            ['order_number' => 'AU-2026-1008', 'customer' => 'Studio Nord', 'category' => 'Verkauf', 'amount' => 7600.00, 'ordered_at' => '2026-10-12', 'status' => 'offen'],
            ['order_number' => 'AU-2026-1009', 'customer' => 'Atelier Blau', 'category' => 'Service', 'amount' => 980.00, 'ordered_at' => '2026-10-17', 'status' => 'bezahlt'],
            ['order_number' => 'AU-2026-1010', 'customer' => 'Hofmann Consulting', 'category' => 'Miete', 'amount' => 2700.00, 'ordered_at' => '2026-10-21', 'status' => 'offen'],
            ['order_number' => 'AU-2026-1011', 'customer' => 'Kreativwerkstatt AG', 'category' => 'Service', 'amount' => 640.00, 'ordered_at' => '2026-10-24', 'status' => 'bezahlt'],
            ['order_number' => 'AU-2026-1012', 'customer' => 'Zürich Design Lab', 'category' => 'Verkauf', 'amount' => 9400.00, 'ordered_at' => '2026-10-29', 'status' => 'offen'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('demo_orders');
    }
};
