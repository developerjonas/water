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
        // Drop old table if it exists
        Schema::dropIfExists('financial_reports');

        // Create the new table
        Schema::create('financial_reports', function (Blueprint $table) {
            $table->id(); // SN (auto increment primary key)

            // Foreign key to schemes table for scheme code and name
            $table->foreignId('scheme_id')->constrained('schemes')->onDelete('cascade');

            // Estimated costs
            $table->decimal('helvetas_estimated_cash', 15, 2)->nullable();
            $table->decimal('helvetas_estimated_kd', 15, 2)->nullable();
            $table->decimal('rms_estimated', 15, 2)->nullable();
            $table->decimal('users_estimated', 15, 2)->nullable();
            $table->decimal('others_estimated', 15, 2)->nullable();
            $table->decimal('estimated_total', 15, 2)->nullable();

            // Actual expenditure
            $table->decimal('helvetas_actual_cash', 15, 2)->nullable();
            $table->decimal('helvetas_actual_kd', 15, 2)->nullable();
            $table->decimal('rms_actual', 15, 2)->nullable();
            $table->decimal('users_actual', 15, 2)->nullable();
            $table->decimal('others_actual', 15, 2)->nullable();
            $table->decimal('actual_total', 15, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_reports');
    }
};
