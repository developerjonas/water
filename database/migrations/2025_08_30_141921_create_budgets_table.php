<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();

            // Identifiers
            $table->string('scheme_code'); // Foreign Key to schemes
            $table->string('budget_code')->unique()->nullable(); // Unique identifier (nullable if not in csv)

            // 1. Helvetas Data
            $table->decimal('helvetas_estimated_cash', 15, 2)->default(0);
            $table->decimal('helvetas_estimated_kind', 15, 2)->default(0);
            $table->decimal('helvetas_estimated_total', 15, 2)->default(0); // Sum of Cash + Kind

            // 2. Other Contributions
            $table->decimal('community_contribution', 15, 2)->default(0); // "Community Contribution"
            $table->decimal('palika_estimated', 15, 2)->default(0);       // "Palika Estimated"

            // 3. Grand Total
            $table->decimal('total_estimated', 15, 2)->default(0);        // "Total Estimated"

            // Meta Data
            $table->text('remarks')->nullable();
            $table->string('budget_status')->default('draft'); // draft, finalized

            $table->timestamps();

            // Constraints
            $table->foreign('scheme_code')
                  ->references('scheme_code')
                  ->on('schemes')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};