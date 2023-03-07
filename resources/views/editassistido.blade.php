@extends('layouts.main')

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
        <div class="form-group">
        <p>
            <input type="submit" class="btn btn-secondary" value="Confirmar alterações" >
        </p>
    </div>
</div>
<button type="button" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#exampleModalCenter">
    Deletar assistido
</button>
</form>

<!-- Modal -->
<form action="{{ route('assistido.destroy', $assistido->id) }}" method="POST">
    @csrf
    @method('DELETE')
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Deletar assistido</h5>
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p>
                Você tem certeza que deseja deletar?<br>
                Essa ação não poderá ser desfeita.<br>
                <span style="font-weight:bold">
                    Todos os agendamentos envolvendo o assitido<br>
                    serão excluídos.
                </span>
            </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger delete-btn btn-sm">Confirmar</button>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection
