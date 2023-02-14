<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historicos', function (Blueprint $table) {
            $table  ->  id();
            $table  ->  dateTime('start');
            $table  ->  text('parecer')->nullable();
            $table  ->  text('info')->nullable();
            $table  ->  foreignId('agenda_id')->constrained();
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
        Schema::dropIfExists('historico');
    }
}
