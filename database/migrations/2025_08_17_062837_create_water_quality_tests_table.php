<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('water_quality_tests', function (Blueprint $table) {
            $table->id();

            // 1. Linking (Flexible)
            $table->string('scheme_code'); // Required: Every test belongs to a scheme
            
            // Optional: Link to a specific asset if it exists
            $table->foreignId('water_point_id')
                  ->nullable()
                  ->constrained('water_points')
                  ->nullOnDelete();

            // New: Store the text name from Excel (e.g., "BSS2", "School")
            $table->string('tested_point_name')->nullable();

            // 2. Timeline (Crucial)
            $table->date('test_date')->nullable();

            // 3. The Results
            $table->integer('ecoli')->default(0);
            $table->integer('coliform')->default(0);
            
            $table->decimal('ph', 4, 1)->nullable(); // e.g., 7.4
            $table->decimal('frc', 4, 2)->nullable(); // e.g., 0.20
            $table->decimal('turbidity', 5, 2)->nullable(); // e.g., 5.00

            $table->text('remarks')->nullable();
            $table->timestamps();

            // FK Constraint for Scheme
            $table->foreign('scheme_code')
                  ->references('scheme_code')
                  ->on('schemes')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('water_quality_tests');
    }
};