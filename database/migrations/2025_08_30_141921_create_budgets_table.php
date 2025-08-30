<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();

            // Reference to scheme
            $table->string('scheme_code'); // FK to schemes table
            $table->string('budget_code')->unique(); // unique budget identifier

            // Hardcoded budget columns
            $table->decimal('helvetas_cash_estimated', 15, 2)->default(0);
            $table->decimal('helvetas_cash_actual', 15, 2)->default(0);

            $table->decimal('helvetas_kind_estimated', 15, 2)->default(0);
            $table->decimal('helvetas_kind_actual', 15, 2)->default(0);

            $table->decimal('helvetas_total_estimated', 15, 2)->default(0);
            $table->decimal('helvetas_total_actual', 15, 2)->default(0);

            $table->decimal('users_estimated', 15, 2)->default(0);
            $table->decimal('users_actual', 15, 2)->default(0);

            $table->decimal('individual_private_tap_estimated', 15, 2)->default(0);
            $table->decimal('individual_private_tap_actual', 15, 2)->default(0);

            $table->decimal('palika_estimated', 15, 2)->default(0);
            $table->decimal('palika_actual', 15, 2)->default(0);

            $table->decimal('total_estimated', 15, 2)->default(0);
            $table->decimal('total_actual', 15, 2)->default(0);

            // Remarks and status
            $table->text('remarks')->nullable();
            $table->string('budget_status')->default('draft'); // draft, finalized, verified

            $table->timestamps();

            // Foreign key constraint
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
