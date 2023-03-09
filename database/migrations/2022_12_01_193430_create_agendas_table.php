<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table  ->  id();
            $table  ->  dateTime('start');
            $table  ->  dateTime('end');
            $table  ->  string('dia');
            $table  ->  integer('dur')->nullable();
            $table  ->  integer('vag_h');
            $table  ->  integer('vag_h_max')->nullable();
            $table  ->  text('info')->nullable();
            $table  ->  boolean('Status')->default('0');
            $table  ->  foreignId('historico_id')->nullable();
            $table  ->  foreignId('user_id')->constrained();
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
        Schema::dropIfExists('agendas');
    }
}
