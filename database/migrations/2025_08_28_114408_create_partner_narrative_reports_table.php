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

            // Foreign key: partner_code instead of partner_id
            $table->string('partner_code');
            $table->foreign('partner_code')
                ->references('partner_code')
                ->on('partners')
                ->onDelete('cascade');

            // Reporting details
            $table->string('reporting_period'); // Q1, Q2, Q3, Q4, Semiannual, Annual
            $table->text('notes')->nullable(); // optional additional info

            // Report files (JSON for multiple files)
            $table->json('report_files')->nullable();

            $table->timestamps();

            // Index for faster lookup
            $table->index('partner_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partner_narrative_reports');
    }
};
