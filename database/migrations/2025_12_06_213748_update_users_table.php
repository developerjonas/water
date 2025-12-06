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
        Schema::table('users', function (Blueprint $table) {
            // $table->foreignId('district_id')->nullable()->index();
            $table->string('district_code', 10)->nullable()->index(); 
            
            // 2. Define the foreign key constraint
            $table->foreign('district_code')
                  ->references('district_code') // The column in the districts table
                  ->on('districts')             // The districts table
                  ->nullOnDelete();             // Action on delete


            // $table->foreignId('municipality_id')->nullable()->index();

            $table->string('municipality_code', 50)->nullable()->index(); 
            
            // 2. Define the foreign key constraint
            $table->foreign('municipality_code')
                  ->references('municipality_code') 
                  ->on('municipalities')            
                  ->nullOnDelete();             

            $table->string('role')->default('viewer')->index();
            $table->boolean('is_active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['district_id', 'municipality_id', 'role']);
        });
    }
};