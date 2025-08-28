<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partner_narrative_reports', function (Blueprint $table) {
            $table->id();

            // Foreign key: partner
            $table->foreignId('partner_id')->constrained()->onDelete('cascade');

            // Reporting details
            $table->string('reporting_period'); // Q1, Q2, Q3, Q4, Semiannual, Annual
            $table->text('notes')->nullable(); // optional additional info

            // Report files (can be multiple URLs separated by comma, or use JSON)
            $table->json('report_files')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partner_narrative_reports');
    }
};
