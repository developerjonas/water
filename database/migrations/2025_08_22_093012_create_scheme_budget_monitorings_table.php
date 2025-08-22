<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('scheme_budget_monitorings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scheme_budget_installment_id')
                  ->constrained('scheme_budget_installments')
                  ->onDelete('cascade');

            $table->string('description')->nullable(); // "Construction Materials", "Labour", etc.
            $table->decimal('estimated_amount', 15, 2)->nullable();
            $table->decimal('spent_amount', 15, 2)->nullable();
            $table->boolean('verified')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scheme_budget_monitorings');
    }
};
