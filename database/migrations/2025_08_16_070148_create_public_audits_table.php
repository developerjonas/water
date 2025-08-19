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

            // Audit type
            $table->enum('audit_type', ['Public Audit - I', 'Public Audit - II', 'Public Audit - III'])->nullable();

            // Participant counts
            $table->integer('dalit_female')->default(0);
            $table->integer('dalit_male')->default(0);
            $table->integer('janjati_female')->default(0);
            $table->integer('janjati_male')->default(0);
            $table->integer('other_female')->default(0);
            $table->integer('other_male')->default(0);

            // Total participants
            $table->integer('total')->virtualAs('dalit_female + dalit_male + janjati_female + janjati_male + other_female + other_male');

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
