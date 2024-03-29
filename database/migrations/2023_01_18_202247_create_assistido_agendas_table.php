<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssistidoAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistido_agendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agenda_id')->nullable();
            $table->foreignId('assistido_id')->nullable();
            $table->string('nome_assistido')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assistido_agenda');
    }
}
