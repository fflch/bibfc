<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('titulo');
            $table->integer('tombo');
            $table->string('tombo_tipo');
            $table->string('autor')->nullable();
            $table->string('editora')->nullable();
            $table->string('local')->nullable();
            $table->integer('ano')->nullable();
            $table->string('edicao')->nullable();
            $table->integer('exemplar')->nullable();
            $table->string('volume')->nullable();
            $table->string('localizacao')->nullable();
            $table->text('obs')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livros');
    }
}
