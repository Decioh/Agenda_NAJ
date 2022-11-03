@extends('layouts.main')

@section('title', 'Meus agendamentos')

@section('content')    

<div class="col-md10 offset-md-1 dashboard-title-container" style="margin-left: 0px">
    <h2>Meus eventos</h2>
</div>
<div class="col-md10 offset-md-1 dashboard-title-container" style="margin-left: 0px">
    @if(count($events)>0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Dia</th>
                <th scope="col">Assistido</th>
                <th scope="col">Horario</th>
                <th scope="col">Duração</th>
                <th scope="col">Vagas</th>
            </tr>
        </thead>
    <tbody>
        @foreach($event as $events)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td><a href="/novo{{ $event->id }}">{{ $event-> assistido }}</a></td>
            </tr>
        @endforeach
    </tbody>
    @else
    <p>Você ainda não criou um horario de atendimento. <a href="/novo/create">Criar novo agendamento</a></p>
    @endif
</div>

@endsection