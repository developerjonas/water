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
            // Intakes & RVTs
            // -------------------
            $table->integer('intakes_planned')->default(0);
            $table->integer('intakes_constructed')->default(0);
            $table->integer('intakes_remaining')->default(0);

            $table->integer('rvts_planned')->default(0);
            $table->integer('rvts_constructed')->default(0);
            $table->integer('rvts_remaining')->default(0);

            // -------------------
            // Structures
            // -------------------
            $table->integer('cc_dc_bpt_planned')->default(0);
            $table->integer('cc_dc_bpt_constructed')->default(0);
            $table->integer('cc_dc_bpt_remaining')->default(0);

            $table->integer('other_structures_planned')->default(0);
            $table->integer('other_structures_constructed')->default(0);
            $table->integer('other_structures_remaining')->default(0);

            // -------------------
            // Taps
            // -------------------
            $table->integer('public_taps_planned')->default(0);
            $table->integer('public_taps_constructed')->default(0);
            $table->integer('public_taps_remaining')->default(0);

            $table->integer('school_taps_planned')->default(0);
            $table->integer('school_taps_constructed')->default(0);
            $table->integer('school_taps_remaining')->default(0);

            $table->integer('private_taps_planned')->default(0);
            $table->integer('private_taps_constructed')->default(0);
            $table->integer('private_taps_remaining')->default(0);

            // -------------------
            // Lines
            // -------------------
            $table->integer('transmission_line_planned')->default(0);
            $table->integer('transmission_line_constructed')->default(0);
            $table->integer('transmission_line_remaining')->default(0);

            $table->integer('distribution_line_planned')->default(0);
            $table->integer('distribution_line_constructed')->default(0);
            $table->integer('distribution_line_remaining')->default(0);

            $table->integer('private_line_planned')->default(0);
            $table->integer('private_line_constructed')->default(0);
            $table->integer('private_line_remaining')->default(0);

            // -------------------
            // Remarks
            // -------------------
            $table->text('remarks')->nullable();

            $table->timestamps();

            // -------------------
            // Indexes & FKs
            // -------------------
            $table->index('scheme_code');
            $table->foreign('scheme_code')->references('scheme_code')->on('schemes')->onDelete('cascade');
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
