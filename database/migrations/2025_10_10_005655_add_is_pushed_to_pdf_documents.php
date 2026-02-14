<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pdf_documents', function (Blueprint $table) {
            $table->boolean('is_pushed')->default(false)->after('size');
            $table->timestamp('pushed_at')->nullable()->after('is_pushed');
        });
    }

    public function down()
    {
        Schema::table('pdf_documents', function (Blueprint $table) {
            $table->dropColumn(['is_pushed', 'pushed_at']);
        });
    }
};
