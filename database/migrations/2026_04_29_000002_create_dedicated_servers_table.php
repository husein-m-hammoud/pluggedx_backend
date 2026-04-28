<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dedicated_servers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('specs'); // [{"label":"CPU","value":"AMD EPYC 4244P"}, ...]
            $table->boolean('highlighted')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dedicated_servers');
    }
};
