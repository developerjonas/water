<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('scheme_budget_settlements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scheme_budget_monitoring_id')
                  ->constrained('scheme_budget_monitorings')
                  ->onDelete('cascade');

            $table->decimal('settled_amount', 15, 2)->nullable();
            $table->boolean('approved')->default(false);   // Helvetas approved
            $table->boolean('recovered')->default(false);  // Money returned if fraud

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scheme_budget_settlements');
    }
};
