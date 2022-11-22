@extends('layouts.main')

@section('tile', 'Cadastro')

@section('content')


        <div class="info-cadastro">
            <p class="card-date">Agendamento para {{$event -> dia}} dia {{date('d/m', strtotime($event -> start))}} <br> de {{date('H:i', strtotime($event -> start))}} até {{date('H:i', strtotime($event -> end))}}</p>
        </div>
<form action="novo/update/{{ $event -> id }}" method="POST">
    @csrf
    @method("PUT")
    <input type="hidden" name="id" value="{{$event['id']}}">
<div class="cadastro"><br>
    <div class="cadastron">
        <label for="assistido">Nome:</label>
        <input type="text" id="assistido" name="assistido" required>
    </div><br>
    <div class="cadastrod">
        <label for="nasc">data de nascimento: &nbsp;<input type="date"  id="nasc" name="nasc"></label>
        
    </div> <br>
    <div class="cadastrocpf"> 
        <label for="cpf">cpf:</label>
        <input type="number" id="cpf" name="cpf" minlength="11" maxlength="11">
    </div> <br>
    <div class="cadastrocep"> 
        <label for="cep">cep:</label>
        <input type="number" id="cep" name="cep" minlength="8" maxlength="8">
    </div> <br>
    <div> <br>
        <label for="info">Informações adicionais:</label><br><br>
        <textarea id="info" name="info"></textarea>
    </div> <br>
    <div>
        <input type="hidden" value="{{$event -> vag_h}}" id="vag_h" name="vag_h">
    </div>
    <div class="form-group">
        <p>
            <input type="submit" class="btn btn-secondary" value="Agendar" >
            <input type="reset" class="btn btn-secondary" value="Limpar" >
        </p>
    </div>
</div>
</form>


@endsection