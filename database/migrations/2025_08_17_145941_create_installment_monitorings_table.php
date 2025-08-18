<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('installment_monitorings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scheme_id')->constrained('schemes')->cascadeOnDelete();
            $table->enum('installment_number', ['1', '2', '3'])->default('1');
            $table->date('installment_date');
            $table->decimal('installment_amount', 12, 2);
            $table->enum('monitoring_type', ['Monitoring I', 'Monitoring II', 'Monitoring III', 'Monitoring IV'])->nullable();
            $table->date('monitoring_date')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Optional, in case you want soft deletes
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('installment_monitorings');
    }
};
