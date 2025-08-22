<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scheme_budgets', function (Blueprint $table) {
            $table->id();

            // Link to Scheme
            $table->foreignId('scheme_code')->constrained('schemes')->onDelete('cascade');

            // Sub-schemes as comma-separated names
            $table->string('sub_schemes')->nullable();

            // Estimated amounts
            $table->decimal('estimated_amount', 15, 2)->nullable();
            $table->decimal('estimated_helvetas_cash', 15, 2)->nullable();
            $table->decimal('estimated_helvetas_kd', 15, 2)->nullable();
            $table->decimal('estimated_municipality', 15, 2)->nullable();
            $table->decimal('estimated_users', 15, 2)->nullable();
            $table->decimal('estimated_others', 15, 2)->nullable();

            // Actual amounts
            $table->decimal('actual_amount', 15, 2)->nullable();
            $table->decimal('actual_helvetas_cash', 15, 2)->nullable();
            $table->decimal('actual_helvetas_kd', 15, 2)->nullable();
            $table->decimal('actual_municipality', 15, 2)->nullable();
            $table->decimal('actual_users', 15, 2)->nullable();
            $table->decimal('actual_others', 15, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scheme_budgets');
    }
};
