<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table  ->  id();
            $table  ->  dateTime('start');
            $table  ->  dateTime('end');
            $table  ->  string('dia');
            $table  ->  integer('dur')->nullable();
            $table  ->  integer('vag_h');
            $table  ->  timestamps();
            $table  ->  string('assistido');
            $table  ->  date('nasc')->nullable();
            $table  ->  char('cpf',11)->nullable();
            $table  ->  char('cep',8)->nullable();
            $table  ->  text('info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
?>