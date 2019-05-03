<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLivros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_livros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();


            
            $table->string('titulo');
            $table->string('descricao');
            $table->timestamp('ano');
            $table->string('autor');
            $table->string('editora');
            $table->string('imagem')-nullable();
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_livros');
    }
}
