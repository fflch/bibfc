<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Emprestimo;

class RenewFieldOnEmprestimosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emprestimos', function (Blueprint $table) {
            $table->integer('renew')->nullable()->default(0);
        });
        
        foreach(Emprestimo::all() as $emprestimo){
            $emprestimo->renew = 0;
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
            $table->dropColumn('renew');
        });
    }
}
