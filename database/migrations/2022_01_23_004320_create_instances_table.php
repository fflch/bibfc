<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instances', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('tombo')->nullable();
            $table->string('tombo_tipo')->nullable();

            # Ativo, Perdido, Muito Atrasado, Danificado
            $table->string('status')->default('Ativo');

            $table->integer('exemplar')->nullable();
            $table->string('complemento_localizacao')->nullable();
            $table->text('notas')->nullable();

            $table->unsignedBigInteger('livro_id');
            $table->foreign('livro_id')->references('id')->on('livros')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instances');
    }
}
