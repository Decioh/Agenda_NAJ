@extends('layouts.main')

@section('title', 'adicionar parecer')

@section('content')

<script>
    function show(i){
        if (i==1) document.getElementById("parte_faltante").style.display="block";
        else document.getElementById("parte_faltante").style.display="none";
        return;
    }
</script>
<div class="card mx-auto my-5" style="width: 23rem;">
    <div class="row d-flex justify-content-center">
    <div class="card-body">
      <h5 class="card-title">{{$agenda->dia}}</h5>
      <h6 class="card-subtitle mb-2 text-muted">{{date('d/m/y H:i', strtotime($agenda -> start))}}</h6>
      <p class="card-text">Informações do agendamento:<br>
        {{$agenda->info}} </p>
        <span style="font-weight: bold;">Partes:</span><br>
        @foreach($assistido_agendas as $assistido_agendas)
            <div class="my-1">{{($assistido_agendas->nome_assistido)}} </div>
        @endforeach

<form action="{{ route('historico.store', $agenda->id) }}" method="POST">
@csrf
<div class="mx-auto"> <br>
    <label class="my-2" for="parecer">Parecer final:</label><br>
    <select name="parecer" id="parecer">
        <option value="Acordo inviável" onclick="show(0)" >Acordo inviável</option>
        <option value="Acordo realizado" onclick="show(0)">Acordo realizado</option>
        <option value="Processo judicializado" onclick="show(0)">Processo judicializado</option>
        <option value="Parte não compareceu" onclick="show(1)" selected>Parte não compareceu</option>
    </select><br>
    <select name="parte_faltante" id="parte_faltante" class="custom-select-sm my-3" size="1">
        <label class="my-2" for="pfinal">Qual parte faltou?</label><br>
    @foreach($agendas_assistidos as $agendas_assistidos)
        <option value="{{$agendas_assistidos->nome_assistido}}">{{$agendas_assistidos->nome_assistido}}</option>        
    @endforeach
        <option value="Ambas">Todas as partes</option>
    </select><br>
    <label class="my-2" for="pindo">Informações adicionais:</label><br>
    <textarea  id="info" name="info"></textarea>
</div> <br>
<input type="submit" class="btn btn-success" value="Finalizar mediação" >
</form>
    


@endsection