@extends('layouts.main')

@section('tile', 'Agendando Assistido')

@section('content')


        <div class="info-cadastro">
            <p class="card-date">Agendando para {{$event -> dia}} dia {{date('d/m', strtotime($event -> start))}} <br> de {{date('H:i', strtotime($event -> start))}} até {{date('H:i', strtotime($event -> end))}}</p>
        </div>
<form action="/novo/update/{{ $event -> id}}" method="POST">
    @csfr
    @method('PUT')
<div class="cadastro"><br>
    <div class="cadastron">
        <label for="assistido">Nome:</label>
        <input type="text" id="assistido" name="assistido">
    </div><br>
    <div class="cadastrod">
        <label for="nasc">data de nascimento: &nbsp;<input type="date"  id="nasc" name="nasc"></label>
        
    </div> <br>
    <div class="cadastrocpf"> 
        <label for="cpf">cpf:</label>
        <input type="number" id="cpf" name="cpf">
    </div> <br>
    <div class="cadastrocep"> 
        <label for="cep">cep:</label>
        <input type="number" id="cep" name="cep">
    </div> <br>
    <div> <br>
        <label for="info">Informações adicionais:</label><br><br>
        <textarea id="info" name="info"></textarea>
    </div> <br>
    <div class="form-group">
        <p>
            <input type="submit" class="btn btn-secondary" value="Criar" >
            <input type="reset" class="btn btn-secondary" value="Limpar" >
        </p>
    </div>
</div>
</form>


@endsection