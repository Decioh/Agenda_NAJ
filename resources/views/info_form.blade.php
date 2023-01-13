@extends('layouts.main')

@section('title', 'Informações assistido')

@section('content')    

<h3 class="mt-3">Informações assistido</h3>
<p>
    Nome: {{$assistido -> nome}}<br>
    nasc: @if($assistido->nasc != null){{date('d/m/Y', strtotime($assistido -> nasc))}} @else - @endif<br>
    @php
    $cpf = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $assistido -> cpf);
    $tel = preg_replace("/(\d{0})(\d{2})(\d{5})(\d{4})/", "\$1(\$2)\$3-\$4", $assistido -> telefone);
    @endphp
    cpf: {{$cpf}}<br>
    email: {{$assistido -> email}}<br>
    telefone: {{$tel}}<br>
    Informações adicionais: {{$assistido -> info}}   
</p>

<form action="{{ route('agenda.info',$assistido -> id, $agenda -> id) }}" method="POST">
@csrf
<div> <br>
    <label for="info">Informações sobre o agendamento:</label><br><br>
    <textarea id="info" name="info"></textarea>
</div> <br>
<input type="submit" class="btn btn-success" value="Agendar" >
</form>
    


@endsection