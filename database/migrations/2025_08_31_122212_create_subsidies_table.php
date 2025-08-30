<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('subsidies', function (Blueprint $table) {
            $table->id();

            // Foreign to Budget
            $table->foreignId('budget_id')->constrained('budgets')->onDelete('cascade');

            // Section / Sub-item
            $table->string('section')->nullable();        // e.g., A, B, C
            $table->string('sub_item')->nullable();       // e.g., A.1, A.2.1.1
            $table->string('description')->default('Unknown'); // e.g., "Loading", "Portering"

            // Estimates
            $table->decimal('original_estimated', 12, 2)->default(0);
            $table->decimal('additional_estimated', 12, 2)->default(0);
            $table->decimal('total_estimated', 12, 2)->default(0);

            // Advances
            $table->decimal('advance_1', 12, 2)->default(0);
            $table->decimal('advance_2', 12, 2)->default(0);
            $table->decimal('advance_3', 12, 2)->default(0);

            // Settlements
            $table->decimal('settlement_1', 12, 2)->default(0);
            $table->decimal('settlement_2', 12, 2)->default(0);
            $table->decimal('settlement_3', 12, 2)->default(0);

            // Optional: for ordering in the table/form
            $table->integer('order')->nullable();

            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('subsidies');
    }
};
