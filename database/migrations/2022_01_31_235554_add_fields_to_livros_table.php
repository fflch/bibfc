<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToLivrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('livros', function (Blueprint $table) {
            $table->dropColumn('autor');

            $table->string('isbn')->nullable();
            $table->string('dimensao')->nullable();
            $table->string('ilustrado')->nullable();
            $table->string('colorido')->nullable();
            $table->string('extensao')->nullable(); // quantidade de páginas

            $table->string('ano')->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('livros', function (Blueprint $table) {
            //
        });
    }
}
