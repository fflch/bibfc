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
        Schema::table('livros', function (Blueprint $table) {
            $table->boolean('status')->nullable();//pré-catalogação.s
            /*
                NULL == 'Em espera'
                0 = 'Reprovado'
                1 = 'Aprovado'
            */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('livros', function (Blueprint $table) {
            //
        });
    }
};
