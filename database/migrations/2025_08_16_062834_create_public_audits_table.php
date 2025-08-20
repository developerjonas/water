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
        Schema::create('public_audits', function (Blueprint $table) {
            $table->id();

            // Link to Scheme via scheme_code
            $table->string('scheme_code');
            $table->foreign('scheme_code')->references('scheme_code')->on('schemes')->onDelete('cascade');

            // Audit type as string for flexibility
            $table->string('audit_type')->nullable();

            // Audit date
            $table->date('audit_date')->nullable();

            // Participant counts stored as JSON
            $table->json('participant_counts')->nullable(); 

            // Optional scanned document uploads
            $table->json('audit_documents')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_audits');
    }
};
