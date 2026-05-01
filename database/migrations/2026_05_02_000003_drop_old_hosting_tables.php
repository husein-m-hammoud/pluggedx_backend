<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('vps_plans');
        Schema::dropIfExists('dedicated_servers');
    }

    public function down(): void
    {
        // Restore stubs so rollback doesn't break — full data is in HostingSeeder
        Schema::create('vps_plans', function ($table) {
            $table->id();
            $table->string('name');
            $table->json('specs');
            $table->boolean('highlighted')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('dedicated_servers', function ($table) {
            $table->id();
            $table->string('name');
            $table->json('specs');
            $table->boolean('highlighted')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }
};
