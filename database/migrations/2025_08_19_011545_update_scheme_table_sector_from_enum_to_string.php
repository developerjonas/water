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
        Schema::table('schemes', function (Blueprint $table) {
            // Change 'sector' from ENUM to STRING (VARCHAR)
            $table->string('sector', 50)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schemes', function (Blueprint $table) {
            // Revert back to ENUM (adjust enum values as needed)
            $table->enum('sector', ['WATER', 'SAN', 'ENERGY'])->nullable()->change();
        });
    }
};
