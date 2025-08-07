<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('divisions')->insert([
            ['name' => 'Dhaka', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chattogram', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rajshahi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Khulna', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Barishal', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sylhet', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rangpur', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mymensingh', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('divisions');
    }
};
