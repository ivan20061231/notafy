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
             $table->float('nota1')->nullable();
        $table->float('nota2')->nullable();
        $table->float('definitiva')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estudiante_materia', function (Blueprint $table) {
            //
        });
    }
};
