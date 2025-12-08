<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('water_points', function (Blueprint $table) {
            $table->id();

            // -------------------
            // 1. LINKING (Scheme)
            // -------------------
            // Foreign Key to the schemes table (using scheme_code string key)
            $table->string('scheme_code')->comment('Links to schemes.scheme_code');

            // -------------------
            // 2. IDENTIFICATION
            // -------------------
            $table->string('water_point_name')->comment('Water Point / Owner Name');
            
            // Using string for Location Type to handle CSV variants ("Community" vs "community")
            $table->string('location_type')->default('Community')->comment('Community, School, etc.');
            
            $table->string('tole')->nullable()->comment('Tole / Cluster');
            $table->string('ward_no')->nullable()->comment('Ward No (String to support 1,2,8&9)');
            
            // Using string for Status ("Yes"/"No")
            $table->string('tap_construction_status')->comment('Yes / No');

            // -------------------
            // 3. SOCIO-ECONOMIC PROFILE
            // -------------------
            $table->integer('households_count')->default(1)->comment('HH Count');
            $table->string('ethnicity')->nullable()->comment('Dalit, Janjati, Other, Muslim');
            $table->string('economic_status')->nullable()->comment('Poor, Non-Poor, Ultra-Poor');

            // -------------------
            // 4. USER DEMOGRAPHICS
            // -------------------
            $table->integer('woman')->default(0)->comment('Female users');
            $table->integer('man')->default(0)->comment('Male users');
            $table->integer('total_users')->default(0)->comment('Calculated total');

            // -------------------
            // 5. ADDITIONAL INFO
            // -------------------
            $table->text('remarks')->nullable();

            // -------------------
            // Standard Timestamps & Indexes
            // -------------------
            $table->timestamps();
            
            // Index for faster lookups
            $table->index('scheme_code');

            // Optional: Foreign Key Constraint (Enable if you want strict enforcement)
            $table->foreign('scheme_code')
                  ->references('scheme_code')
                  ->on('schemes')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('water_points');
    }
};