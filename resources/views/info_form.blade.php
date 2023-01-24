@extends('layouts.main')

@section('title', 'Informações assistido')

@section('content')    


<form action="{{ route('agenda.info', $agenda_id) }}" method="POST">
@csrf
<div> <br>
    <label for="info">Informações sobre o agendamento:</label><br><br>
    <textarea id="info" name="info"></textarea>
</div> <br>
<input type="submit" class="btn btn-success" value="Agendar" >
</form>
    


@endsection