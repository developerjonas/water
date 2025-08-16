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

            // Link to Scheme
            $table->foreignId('scheme_id')->constrained('schemes')->onDelete('cascade');

            $table->string('district')->nullable();
            $table->string('palika')->nullable();
            $table->string('donor')->nullable();
            $table->string('scheme_start_year')->nullable();
            $table->string('scheme_name')->nullable();

            $table->string('audit_name')->nullable(); // e.g., Public Audit - I
            $table->date('audit_date')->nullable();

            // Participant counts
            $table->integer('df')->nullable(); // Female participants (District)
            $table->integer('dm')->nullable(); // Male participants (District)
            $table->integer('jf')->nullable(); // Female participants (Junior)
            $table->integer('jm')->nullable(); // Male participants (Junior)
            $table->integer('of')->nullable(); // Female participants (Others)
            $table->integer('om')->nullable(); // Male participants (Others)

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
