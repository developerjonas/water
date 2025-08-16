<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('financial_reports', function (Blueprint $table) {
            $table->id();

            // Link to Scheme
            $table->foreignId('scheme_id')->constrained('schemes')->onDelete('cascade');

            $table->string('district')->nullable();
            $table->string('palika')->nullable();
            $table->string('sector')->nullable();
            $table->integer('sub_schemes')->nullable();

            $table->decimal('estimated_total', 15, 2)->nullable();
            $table->decimal('helvetas_actual', 15, 2)->nullable();
            $table->decimal('rms_actual', 15, 2)->nullable();
            $table->decimal('users_actual', 15, 2)->nullable();
            $table->decimal('others_actual', 15, 2)->nullable();
            $table->decimal('actual_expenditure_total', 15, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financial_reports');
    }
};
