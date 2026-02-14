<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pdf_documents', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // friendly name
            $table->string('slug')->unique(); // slug for safe filenames
            $table->string('pdf_path'); // storage path to final pdf
            $table->string('original_pdf_path')->nullable(); // path to original uploaded pdf
            $table->string('original_filename')->nullable();
            $table->longText('html')->nullable(); // editable html content
            $table->string('mime')->nullable();
            $table->integer('size')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pdf_documents');
    }
};
