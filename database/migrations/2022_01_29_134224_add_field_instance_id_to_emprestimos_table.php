<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Emprestimo;

class AddFieldInstanceIdToEmprestimosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emprestimos', function (Blueprint $table) {
            $table->unsignedBigInteger('instance_id')->nullable();
            $table->foreign('instance_id')->references('id')->on('instances')->onDelete('cascade');
        });
        
        foreach(Emprestimo::all() as $emprestimo){
            $emprestimo->instance_id = $emprestimo->livro_id;
            $emprestimo->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emprestimos', function (Blueprint $table) {
            //
        });
    }
}
