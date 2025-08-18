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
        Schema::create('structure_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scheme_id')->constrained('schemes')->onDelete('cascade');

            $table->integer('intake_estimated')->nullable();
            $table->integer('intake_achieved')->nullable();

            $table->integer('intake_filter_estimated')->nullable();
            $table->integer('intake_filter_achieved')->nullable();

            $table->integer('dc_ic_cc_estimated')->nullable();
            $table->integer('dc_ic_cc_achieved')->nullable();

            $table->integer('rvt_estimated')->nullable();
            $table->integer('rvt_achieved')->nullable();

            $table->integer('bpt_estimated')->nullable();
            $table->integer('bpt_achieved')->nullable();

            $table->integer('frc_estimated')->nullable();
            $table->integer('frc_achieved')->nullable();

            $table->integer('private_tap_estimated')->nullable();
            $table->integer('private_tap_achieved')->nullable();

            $table->integer('institutional_tap_estimated')->nullable();
            $table->integer('institutional_tap_achieved')->nullable();

            $table->integer('transmission_line_estimated')->nullable();
            $table->integer('transmission_line_achieved')->nullable();

            $table->integer('distribution_line_estimated')->nullable();
            $table->integer('distribution_line_achieved')->nullable();

            $table->integer('private_line_estimated')->nullable();
            $table->integer('private_line_achieved')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('structure_infos');
    }
};
