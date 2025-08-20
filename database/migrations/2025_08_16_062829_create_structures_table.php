<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('structures', function (Blueprint $table) {
            $table->id();

            // -------------------
            // Reference
            // -------------------
            $table->string('scheme_code')->comment('Foreign key to schemes.scheme_code');

            // -------------------
            // Intakes
            // -------------------
            $table->integer('intakes_constructed')->default(0);
            $table->integer('intakes_remaining')->default(0);

            // -------------------
            // RVTs
            // -------------------
            $table->integer('rvts_constructed')->default(0);
            $table->integer('rvts_remaining')->default(0);

            // -------------------
            // CC/DC/BPT/IC/Valvebox
            // -------------------
            $table->integer('cc_dc_bpt_constructed')->default(0);
            $table->integer('cc_dc_bpt_remaining')->default(0);

            // -------------------
            // Other Structures (FRC/Custom)
            // -------------------
            $table->integer('other_structures_constructed')->default(0);
            $table->integer('other_structures_remaining')->default(0);

            // -------------------
            // Taps
            // -------------------
            $table->integer('public_taps')->default(0);
            $table->integer('school_taps')->default(0);
            $table->integer('private_taps')->default(0);
            $table->integer('taps_constructed_progress')->default(0);
            $table->integer('taps_remaining')->default(0);

            // -------------------
            // Lines
            // -------------------
            $table->integer('transmission_line_progress')->default(0);
            $table->integer('transmission_line_remaining')->default(0);
            $table->integer('distribution_line_progress')->default(0);
            $table->integer('distribution_line_remaining')->default(0);
            $table->integer('private_line_progress')->default(0);
            $table->integer('private_line_remaining')->default(0);

            // -------------------
            // Status flags
            // -------------------
            $table->boolean('mb_submitted_to_municipality')->default(false);
            $table->boolean('municipality_contribution_transferred')->default(false);
            $table->boolean('public_hearing_done')->default(false);
            $table->boolean('public_review_done')->default(false);
            $table->boolean('final_public_audit_done')->default(false);
            $table->text('remarks')->nullable();

            $table->timestamps();

            // -------------------
            // Indexes
            // -------------------
            $table->index('scheme_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('structures');
    }
};
