<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssistidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistidos', function (Blueprint $table) {
            $table  ->  id();
            $table  ->  string('nome');
            $table  ->  date('nasc')->nullable();
            $table  ->  char('cpf',11)->nullable();
            $table  ->  char('email',45)->nullable();
            $table  ->  char('telefone',11);
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
        Schema::dropIfExists('assistidos');
    }
}
