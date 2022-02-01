<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Livro;
use App\Models\Responsabilidade;
use App\Models\LivroResponsabilidade;

class CreateLivroResponsabilidadeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livro_responsabilidade', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('livro_id')->nullable();
            $table->foreign('livro_id')->references('id')->on('livros')->onDelete('cascade');

            $table->unsignedBigInteger('responsabilidade_id')->nullable();
            $table->foreign('responsabilidade_id')->references('id')->on('responsabilidades')->onDelete('cascade');
        
            $table->string('tipo');
        });

        foreach(Livro::all() as $livro){
            $responsabilidade = Responsabilidade::where('nome',trim($livro->autor))->first();
            if(!$responsabilidade) {
                $responsabilidade = new Responsabilidade;
                $responsabilidade->nome = trim($livro->autor);
                $responsabilidade->save();
            }
            $livro->responsabilidades()->attach($responsabilidade->id, ['tipo' => 'Autor']);
            $livro->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livro_responsabilidade');
    }
}
