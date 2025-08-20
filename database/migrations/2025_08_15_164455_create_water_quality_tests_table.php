<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('water_quality_tests', function (Blueprint $table) {
            $table->id();

            // Reference to Schemes table via scheme_code
            $table->string('scheme_code');
            $table->foreign('scheme_code')
                  ->references('scheme_code')
                  ->on('schemes')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            // Test Location Info
            $table->string('water_quality_tested_point_name'); // School, HH, RVT, etc.

            // Raw Water Quality Measurements
            $table->unsignedInteger('e_coli')->nullable();
            $table->unsignedInteger('coliform')->nullable();
            $table->decimal('ph', 3, 1)->nullable();
            $table->decimal('frc', 4, 2)->nullable();
            $table->decimal('turbidity', 5, 2)->nullable();

            // Risk Classifications (cannot be derived mathematically)
            $table->string('e_coli_risk_category')->nullable();
            $table->string('e_coli_risk_zone')->nullable();
            $table->string('coliform_risk_category')->nullable();
            $table->string('coliform_risk_zone')->nullable();

            // Timestamps & Soft Deletes
            $table->timestamps();
            $table->softDeletes();

            // Indexes for performance
            $table->index('scheme_code');
            $table->index('water_quality_tested_point_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('water_quality_tests');
    }
};
