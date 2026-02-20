<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    $admin = DB::table('users')
        ->where('email', 'admin@admin.com')
        ->first();

    if (!$admin) {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('Atwi@123$'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $admin = DB::table('users')
            ->where('email', 'admin@admin.com')
            ->first();

        if ($admin) {
            DB::table('users')
                ->where('email', 'admin@admin.com')
                ->delete();
        }
    }
};
