<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('water_quality_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('water_point_id')->constrained('water_points')->onDelete('cascade');

            $table->string('scheme_code'); // FK to schemes
            $table->integer('ecoli')->nullable();
            $table->integer('coliform')->nullable();
            $table->float('ph')->nullable();
            $table->float('frc')->nullable();
            $table->float('turbidity')->nullable();
            $table->text('remarks')->nullable(); // optional notes
            $table->timestamps();

            $table->foreign('scheme_code')->references('scheme_code')->on('schemes')->onDelete('cascade');
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('water_quality_tests');
    }
};
