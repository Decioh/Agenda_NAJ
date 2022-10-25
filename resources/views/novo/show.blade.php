@extends('layouts.main')

@section('tile', 'Cadastro')

@section('content')


        <div class="info-cadastro">
            <p class="card-date">agendamento para {{$event -> dia}} dia {{$event -> start}} até {{$event -> end}}</p>
        </div>
<form action="/novo" method="POST">
<div class="cadastro"><br>
    <div class="cadastron">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome">
    </div><br>
    <div class="cadastrod">
        <label for="vagas">data de nascimento: &nbsp;<input type="date"  id="nasc" name="nasc"></label>
        
    </div> <br>
    <div class="cadastrocpf"> 
        <label for="vagas">cpf:</label>
        <input type="number" id="cpf" name="cpf">
    </div> <br>
    <div class="cadastrocep"> 
        <label for="cep">cep:</label>
        <input type="number" id="cep" name="cep">
    </div> <br>
    <div> <br>
        <label for="info">Informações adicionais:</label><br><br>
        <textarea id="msg"></textarea>
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