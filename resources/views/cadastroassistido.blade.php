@extends('layouts.main')

@section('tile', 'Cadastro')

@section('content')


        <div class="info-cadastro">
            <p class="card-date">Adicionando parte para atendiamento:<br> {{$agenda -> dia}} dia 
                {{date('d/m', strtotime($agenda -> start))}} <br> de {{date('H:i', strtotime($agenda -> start))}} até {{date('H:i', strtotime($agenda -> end))}}</p>
        </div>

<form action="{{ route('assistido.store',$agenda -> id) }}" method="get">
    @csrf
    
    <input type="hidden" name="agenda_id" value="{{$agenda['id']}}">
    <div class="cadastro"><br>
        <div class="cadastron">
            <label for="nome"><span style="font-weight: bold;">Nome:</span></label>
            <input type="text" id="nome" name="nome" required>
        </div><br>
        <div class="cadastrod">
            <label for="nasc"><span style="font-weight: bold;">Data de nascimento:</span>&nbsp;<input type="date"  id="nasc" name="nasc"></label>
            
        </div> <br>
        <div class="cadastrocpf"> 
            <label for="cpf"><span style="font-weight: bold;">CPF:</span></label>
            <input type="text" id="cpf" name="cpf" maxlength="11" required>
        </div> <br>
        <div class="cadastrotel"> 
            <label for="telefone"><span style="font-weight: bold;">Telefone:</span></label>
            <input type="text" id="telefone" name="telefone" maxlength="11" required>
        </div> <br>
        <div class="cadastroemail"> 
            <label for="email"><span style="font-weight: bold;">E-mail:</span></label>
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