<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAgendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_agenda', function (Blueprint $table) {
            $table  ->  id();
            $table  ->  tinyInteger('status');
            $table  ->  timestamps();

            $table  ->  foreignId('assistido_id')->constrained('assistido');
            $table  ->  foreignId('agenda_id')->constrained('agenda');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_agenda');
    }
}
