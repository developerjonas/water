<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('schemes', function (Blueprint $table) {
            $table->enum('sector', ['Water Supply', 'MUS', 'WS', 'Irrigation', 'Sanitation'])
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('schemes', function (Blueprint $table) {
            $table->enum('sector', ['Water Supply', 'MUS'])->change();
        });
    }
};
