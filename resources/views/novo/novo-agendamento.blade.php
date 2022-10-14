@extends('layouts.main')

@section('title', 'Agendamentos')

@section('content')

<h1>Agendamento</h1>


<div id="event-create-container" class="formulario1">

    <form action="/novo" method="POST">
        @csrf
    <div class="form-group">
        <label for="title">Descrição</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Título">
    </div> <br>

    <div class="form-group">
        <label for="começo">Começo dos atendimentos: </label>
        <input type="datetime" class="form-control" id="começo" name="start" placeholder="começo">
    </div> <br>
    <!--<div class="form-group">
        <label for="fim">Fim dos atendimentos: </label>
        <input type="datetime" class="form-control" id="fim" name="end" placeholder="fim">value=$fim disabled=""
    </div>-->
    <div class="form-group">
        <label for="dur">Tempo de cada atendimento:</label>
        <input type="number" min = "1" max="60" id="dur" name="dur">
    </div><br>
    <div class="form-group">
        <label for="vagas">Vagas:</label>
        <input type="number" min="1" max="40" id="vagas" name="vagas">
    </div> <br>
    <div class="form-group">
        <label for="vagas">Simultaneos:</label>
        <input type="number" min="1" max="40" id="vag_hr" name="vag_hr">
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