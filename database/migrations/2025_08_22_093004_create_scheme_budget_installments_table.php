<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('scheme_budget_installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scheme_budget_id')
                  ->constrained('scheme_budgets')
                  ->onDelete('cascade');

            $table->integer('installment_number')->nullable();

            $table->decimal('municipality', 15, 2)->nullable();
            $table->decimal('helvetas_cash', 15, 2)->nullable();
            $table->decimal('helvetas_kd', 15, 2)->nullable();
            $table->decimal('users', 15, 2)->nullable();
            $table->decimal('others', 15, 2)->nullable();
            $table->decimal('total', 15, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scheme_budget_installments');
    }
};
