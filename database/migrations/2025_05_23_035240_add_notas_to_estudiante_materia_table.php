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
        Schema::table('estudiante_materia', function (Blueprint $table) {
            $table->decimal('nota_corte1', 3, 1)->nullable()->after('user_id');
            $table->decimal('nota_corte2', 3, 1)->nullable()->after('nota_corte1');
            $table->decimal('nota_definitiva', 3, 1)->nullable()->after('nota_corte2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estudiante_materia', function (Blueprint $table) {
             $table->dropColumn(['nota_corte1', 'nota_corte2', 'nota_definitiva']);
        });
    }
};
