<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('monitorings', function (Blueprint $table) {
            $table->id();

            $table->string('scheme_code');

            // Link to Budget using budget_code
            $table->string('budget_code');
            $table->foreign('budget_code')->references('budget_code')->on('budgets')->cascadeOnDelete();

            // Monitoring fields
            $table->string('monitoring_code')->unique();
            $table->date('monitoring_date');
            $table->string('monitored_by')->nullable();
            $table->string('status')->default('pending'); // pending, completed, follow-up
            $table->text('remarks')->nullable();
            $table->json('attachments')->nullable();

            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('monitorings');
    }
};
