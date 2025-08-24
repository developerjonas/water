<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('subsidy_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subsidy_id')->constrained('subsidies')->onDelete('cascade');
            $table->string('category_name')->nullable(); // optional grouping/category
            $table->string('item_name')->default('Unknown'); // description
            $table->decimal('total_estimated', 12, 2)->default(0);
            $table->decimal('advance_1', 12, 2)->default(0);
            $table->decimal('advance_2', 12, 2)->default(0);
            $table->decimal('advance_3', 12, 2)->default(0);
            $table->decimal('settlement_1', 12, 2)->default(0);
            $table->decimal('settlement_2', 12, 2)->default(0);
            $table->decimal('settlement_3', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subsidy_items');
    }
};
