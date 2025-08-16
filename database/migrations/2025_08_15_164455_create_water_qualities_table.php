<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('water_qualities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scheme_id')->constrained()->cascadeOnDelete(); // Relation to Scheme
            $table->string('district');
            $table->string('r_m_palika')->nullable();
            $table->string('tested_point')->nullable();

            // Test Results
            $table->integer('e_coli')->nullable();
            $table->integer('coliform')->nullable();
            $table->decimal('ph', 4, 2)->nullable();
            $table->decimal('frc', 5, 2)->nullable();
            $table->decimal('turbidity', 5, 2)->nullable();

            // Risk Indicators
            $table->string('e_coli_risk_category')->nullable();
            $table->decimal('e_coli_percentage', 5, 2)->nullable();
            $table->string('e_coli_risk_zone')->nullable();

            $table->string('coliform_risk_category')->nullable();
            $table->decimal('coliform_percentage', 5, 2)->nullable();
            $table->string('coliform_risk_zone')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('water_qualities');
    }
};
