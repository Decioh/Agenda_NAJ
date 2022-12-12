<@extends('layouts.main')

@section('tile', 'Atualizando cadastro')

@section('content')


    <div class="info-cadastro">
        <p class="card-date">Atualizando dados do Assistido {{$assistido->nome }}</p>
    </div>
    <form action="{{ route('assistido.update',$assistido -> id) }}" method="POST">
    @csrf
<div class="cadastro"><br>
    <div class="cadastron">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="{{$assistido->nome}}" required>
    </div><br>
    <div class="cadastrod">
        <label for="nasc">data de nascimento: &nbsp;<input  value="{{$assistido->nasc}}" type="date"  id="nasc" name="nasc"></label>
        
    </div> <br>
    <div class="cadastrocpf"> 
        <label for="cpf">cpf:</label>
        <input type="text" id="cpf" name="cpf" maxlength="11"value="{{$assistido->cpf}}">
    </div> <br>
    <div class="cadastrotel"> 
        <label for="telefone">telefone:</label>
        <input type="text" id="telefone" name="telefone" maxlength="11"value="{{$assistido->telefone}}">
    </div> <br>
    <div class="cadastroemail"> 
        <label for="email">e-mail:</label>
        <input type="text" id="email" name="email"value="{{$assistido->email}}">
    </div> <br>
    <div> <br>
        <label for="info">Informações adicionais:</label><br><br>
        <textarea  id="info" name="info" value="{{$assistido->info}}"></textarea>
    </div> <br>
        <div class="form-group">
        <p>
            <input type="submit" class="btn btn-secondary" value="Confirmar" >
            <input type="reset" class="btn btn-secondary" value="Limpar" >
        </p>
    </div>
</div>
</form>
<form action="{{ route('assistido.destroy', $assistido -> id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger delete-btn">Deletar assistido</button>
</form>


@endsection