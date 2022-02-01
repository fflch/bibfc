<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Livro;
use App\Models\Instance;

class MovendoCamposDeLivrosParaInstance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('livros', function (Blueprint $table) {
            $table->string('complemento_localizacao')->nullable();
        });

        foreach(Livro::all() as $livro){
            $instance = new Instance;

            # Vamos preservar os id's por conta dos empréstimos
            $instance->id = $livro->id;

            # O exemplar deve pertencer ao livro em questão
            $instance->livro_id = $livro->id;

            # Demais campos
            $instance->tombo = $livro->tombo;
            $instance->tombo_tipo = $livro->tombo_tipo;
            $instance->exemplar = $livro->exemplar;
            
            # quando tipo tombo é Infantil o último campo da localização é a cor
            if($instance->tombo_tipo == 'Infantil') {
                $array_localizacao = explode(' ', $livro->localizacao);
                $livro->complemento_localizacao = array_pop($array_localizacao);

                # Removendo a cor do livro
                $livro->localizacao = implode(' ',$array_localizacao);
                $livro->save();
            }
            $instance->save();
            
            # Eliminando redundância da localização
            $array_localizacao = explode(' ', $livro->localizacao);
            $n = count($array_localizacao);

            if($n > 1) {
                $livro->localizacao = $array_localizacao[0] . ' ' . $array_localizacao[1];
            }

            if($n == 1) {
                $livro->localizacao = $array_localizacao[0];
            }
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
        //
    }
}
