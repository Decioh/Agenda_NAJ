@extends('layouts.main')

@section('title', 'Agendamentos')

@section('content')
<!--Esconder campo de texto-->


@if ((Auth::user()->user_type) == 2)
    <h1>Usuario não autorizado</h1>
@else

<div id="event-create-container" class="formulario1">

    <form action="{{ route('agenda.store') }}" method="POST">
        @csrf
    
    <div class="form-group">
        <legend>Criando horarios de atendimento:</legend>
        <div class="form-group">
         
        
        <label for="começo"><b>Começo:</b> <input type="datetime" class="form-control" id="começo" name="start" placeholder="começo"></label>
        
        <label for="fim" ><b>Final:</b> <input type="datetime" class="form-control" id="fim" name="fim" placeholder="fim"></label>
        
    </div> <br>
    <div> <br>
        
    <div class="form-group">
        <label for="dura"><b>Tempo para cada atendimento:</b></label><br>
        <input type="number" min = "1" max="60" id="dur" name="dur">
    </div><br>
    <div class="form-group">
        <label for="vagas"><b>Vagas:</b></label><br>
        <input type="number" min="1" max="40" id="vagas" name="vagas">
    </div> <br>
    <div class="form-group"> 
        <label for="vagas"><b>Atendimentos simultaneos:</b></label><br>
        <input type="number" min="1" max="40" id="vag_h" name="vag_h">
    </div> <br>
    <div> <br>
        <legend>Selecione os dias que terão atendimento:</legend>
        <input type="checkbox" name="seg" id="1" value="1"> <label for="1">seg</label>
        <input type="checkbox" name="ter" id="2" value="2"> <label for="2">ter</label>
        <input type="checkbox" name="qua" id="3" value="3"> <label for="3">qua</label>
        <input type="checkbox" name="qui" id="4" value="4"> <label for="4">qui</label>
        <input type="checkbox" name="sex" id="5" value="5"> <label for="5">sex</label>
        <input type="checkbox" name="sab" id="6" value="6"> <label for="6">sab</label>
        <input type="checkbox" name="dom" id="0" value="0"> <label for="0">dom</label>
    </div> <br>
    <div class="form-group">
        <p>
            <input type="submit" class="btn btn-success" value="Criar" >
            <input type="reset" class="btn btn-secondary" value="Limpar" >
        </p>
    </div>
    </form>
</div>


@endif
@endsection  