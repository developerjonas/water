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
            $table->foreignId('scheme_id')->constrained()->onDelete('cascade');
            $table->enum('type', [
                'Intake',
                'Intake Filter',
                'DC/IC/CC',
                'RVT',
                'BPT',
                'FRC',
                'Private Tap',
                'Institutional Tap',
                'Transmission Line',
                'Distribution Line',
                'Private Line'
            ]);
            $table->integer('estimated')->nullable();
            $table->integer('achieved')->nullable();
            $table->timestamps();
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
