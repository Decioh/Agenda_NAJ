<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssistidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistido', function (Blueprint $table) {
            $table  ->  id();
            $table  ->  string('nome');
            $table  ->  date('nasc')->nullable();
            $table  ->  char('cpf',11)->nullable();
            $table  ->  char('email',8)->nullable();
            $table  ->  char('telefone',11);
            $table  ->  text('info')->nullable();
            $table  ->  timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assistido');
    }
}
