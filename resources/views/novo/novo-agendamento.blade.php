@extends('layouts.main')

@section('title', 'Agendamentos')

@section('content')

<h1>Agendamento</h1>


<div id="event-create-container" class="formulario1">

    <form action="/novo" method="POST">
        @csrf
    
    <div class="form-group">
        <label for="começo">Começo dos atendimentos:</label><br>
        <input type="datetime" class="form-control" id="começo" name="start" placeholder="começo">
    </div> <br>
    <div class="form-group">
        <label for="dur">Tempo para cada atendimento:</label><br>
        <input type="number" min = "1" max="60" id="dur" name="dur">
    </div><br>
    <div class="form-group">
        <label for="vagas">Vagas:</label><br>
        <input type="number" min="1" max="40" id="vagas" name="vagas">
    </div> <br>
    <div class="form-group"> 
        <label for="vagas">Atendimentos simultaneos:</label><br>
        <input type="number" min="1" max="40" id="vag_h" name="vag_h">
    </div> <br>
    <div> <br>
    <div class="form-group">
        <label for="fim">Data final</label>
        <input type="date" id="fim" name="fim" placeholder="Data final">
    </div> <br>
    </div> <br>
    <div class="form-group">
        <p>
            <input type="submit" class="btn btn-primary" value="Criar" >
            <input type="reset" class="btn btn-primary" value="Limpar" >
        </p>
    </div>
    </form>
</div>
@endsection  