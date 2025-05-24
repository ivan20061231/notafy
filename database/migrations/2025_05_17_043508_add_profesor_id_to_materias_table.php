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
        // Evita error si ya existe la columna
        if (!Schema::hasColumn('materias', 'profesor_id')) {
            Schema::table('materias', function (Blueprint $table) {
                $table->unsignedBigInteger('profesor_id')->nullable()->after('descripcion');
                $table->foreign('profesor_id')->references('id')->on('users')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Elimina la columna si existe
        if (Schema::hasColumn('materias', 'profesor_id')) {
            Schema::table('materias', function (Blueprint $table) {
                $table->dropForeign(['profesor_id']);
                $table->dropColumn('profesor_id');
            });
        }
    }
};
