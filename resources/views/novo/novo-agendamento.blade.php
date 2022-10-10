@extends('layouts.main')

@section('title', 'Agendamentos')

@section('content')


<div id="event-create-container" class="col-md-6 offset-md-3"></div>
    <h1>Criar agenda</h1>
    <form action="/novo" method="POST">
        @csrf
    <div class="form-group">
        <label for="title">Descrição</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="descricao">
    </div> <br>

    <div class="form-group">
        <label for="começo">Começo dos atendimentos: </label>
        <input type="datetime" class="form-control" id="começo" name="start" placeholder="começo">
    </div> <br>
    <div class="form-group">
        <label for="fim">Fim dos atendimentos: </label>
        <input type="datetime" class="form-control" id="fim" name="end" placeholder="fim"> 
    </div><!--
    <div class="form-group"><br>
        <label for="duracao">Duração do atendimento:</label>
        <input type="number" min="1" name="duracao" id="duracao" >  <br>
    </div>
    <div class="form-group"> <br>
        <label for="vagas">Vagas:</label>
        <input type="number" min="1" max="40" id="vagas">
        <label for="Vagas por horario">Vagas por horario:</label>
        <input type="number" min="1" max="40" id="vagas_hr"> <br>
    </div>
    <div class="form-group"> <br>
        <fieldset>
            <input type="checkbox" name="seg" id="0" value = 0> <label for="2">Seg</label>
            <input type="checkbox" name="ter" id="1" value = 1> <label for="3">Ter</label>
            <input type="checkbox" name="qua" id="2" value = 2> <label for="4">Qua</label>
            <input type="checkbox" name="qui" id="3" value = 3> <label for="5">Qui</label>
            <input type="checkbox" name="sex" id="4" value = 4> <label for="6">Sex</label>
            <input type="checkbox" name="sab" id="5" value = 5> <label for="7">Sab</label>
            <input type="checkbox" name="dom" id="6" value = 6> <label for="1">Dom</label>
        </fieldset>-->

        <p>
            <input type="submit" class="btn btn-primary" value="Criar" >
            <input type="reset" class="btn btn-primary" value="Limpar" >
        </p>
    </div>
    </form>
@endsection  