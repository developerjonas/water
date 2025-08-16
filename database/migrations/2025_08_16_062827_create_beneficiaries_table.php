<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();

            $table->string('district')->nullable();
            $table->string('palika')->nullable();

            // Link to scheme
            $table->foreignId('scheme_id')->constrained('schemes')->onDelete('cascade');

            $table->string('sector')->nullable();
            $table->integer('sub_schemes')->nullable();

            $table->integer('total_female')->nullable();
            $table->integer('total_male')->nullable();
            $table->integer('total_beneficiaries')->nullable();

            $table->integer('schools')->nullable();
            $table->integer('taps_provided')->nullable();
            $table->integer('boys_students')->nullable();
            $table->integer('girls_students')->nullable();
            $table->integer('teachers')->nullable();
            $table->integer('total_population')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beneficiaries');
    }
};
