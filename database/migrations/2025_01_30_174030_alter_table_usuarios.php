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
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('prontuario')->nullable();
            $table->string('sala_de_aula')->nullable();
            $table->string('quarto')->nullable();
            $table->boolean('status');
            $table->dropColumn('telefone');
            $table->dropColumn('turma');
            $table->dropColumn('setor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            //
        });
    }
};
