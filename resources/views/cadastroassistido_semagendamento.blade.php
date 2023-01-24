@extends('layouts.main')

@section('tile', 'Cadastro')

@section('content')

<form action="{{ route('assistido.criar')}}" method="POST">
    @csrf
<div class="cadastro"><br>
    <div class="cadastron">
        <label for="nome"><b>Nome:</b></label>
        <input type="text" id="nome" name="nome" required>
    </div><br>
    <div class="cadastrod">
        <label for="nasc"><b>Data de nascimento:</b>&nbsp;<input type="date"  id="nasc" name="nasc"></label>
        
    </div> <br>
    <div class="cadastrocpf"> 
        <label for="cpf"><b>CPF:</b></label>
        <input type="text" id="cpf" name="cpf" maxlength="11" required>
    </div> <br>
    <div class="cadastrotel"> 
        <label for="telefone"><b>Telefone:</b></label>
        <input type="text" id="telefone" name="telefone" maxlength="11" required>
    </div> <br>
    <div class="cadastroemail"> 
        <label for="email"><b>E-mail:</b></label>
        <input type="text" id="email" name="email" required>
    </div> <br>
        <div class="form-group">
        <p>
            <input type="submit" class="btn btn-success" value="Cadastrar" >
            <input type="reset" class="btn btn-secondary" value="Limpar" >
        </p>
    </div>
</div>
</form>


@endsection