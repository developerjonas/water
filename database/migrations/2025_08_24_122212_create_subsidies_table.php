<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('subsidies', function (Blueprint $table) {
            $table->id();
            $table->string('scheme_code'); // just a string
            $table->foreign('scheme_code')
                ->references('scheme_code')      // the string column in schemes table
                ->on('schemes')
                ->onDelete('cascade');
            $table->decimal('total_estimated', 12, 2)->default(0);
            $table->decimal('helvetas_cash', 12, 2)->default(0);
            $table->decimal('helvetas_kind', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subsidies');
    }
};
