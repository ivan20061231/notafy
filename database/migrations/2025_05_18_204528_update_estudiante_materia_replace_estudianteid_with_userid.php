<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('estudiante_materia', function (Blueprint $table) {
            // Eliminar la clave foránea existente y la columna estudiante_id
            if (Schema::hasColumn('estudiante_materia', 'estudiante_id')) {
                $table->dropForeign(['estudiante_id']);
                $table->dropColumn('estudiante_id');
            }

            // Agregar user_id con clave foránea hacia la tabla users
            $table->foreignId('user_id')->after('id')->constrained('users')->onDelete('cascade');
        });

        // (Opcional) Si deseas transferir datos del antiguo campo a user_id, se haría aquí, pero ya eliminamos estudiante_id.
        // Si no hay datos antiguos a migrar, podemos omitirlo.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estudiante_materia', function (Blueprint $table) {
            // Eliminar el campo user_id
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            // Restaurar estudiante_id si fuera necesario
            $table->foreignId('estudiante_id')->constrained('estudiantes')->onDelete('cascade');
        });
    }
};
