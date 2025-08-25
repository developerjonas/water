<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('scheme_sub_systems', function (Blueprint $table) {
            $table->id();

            // Relation to Scheme via scheme_code
            $table->string('scheme_code');
            $table->foreign('scheme_code')
                ->references('scheme_code')
                ->on('schemes')
                ->cascadeOnDelete();

            // Sub-system details
            $table->string('name')->comment('Sub-system name or identifier');
            $table->string('type')->nullable()->comment('Type of subsystem, optional');
            $table->integer('sequence')->nullable()->comment('Order or sequence in the scheme');

            // Optional flags
            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_systems');
    }
};
