<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hosting_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('hosting_categories')->cascadeOnDelete();
            $table->string('name');
            $table->json('specs'); // [{"label":"vCPU","value":"6 vCores"}, ...]
            $table->boolean('highlighted')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hosting_plans');
    }
};
