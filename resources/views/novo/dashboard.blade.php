@extends('layouts.main')

@section('title', 'Meus agendamentos')

@section('content')    

<div class="col-md10 offset-md-1 dashboard-title-container" style="margin-right: 160px">
    <h2>Meus agendamentos</h2>
</div>
<div class="col-md10 offset-md-1 dashboard-title-container pb-5" style="margin-right: 160px">
    @if(count($events) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Dia</th>
                <th scope="col">Assistido</th>
                <th scope="col">Horario</th>
                <th scope="col">Duração</th>
                <th scope="col">Vagas</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
    <tbody>
        @foreach($events as $event)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{$event -> dia}} - {{date('d/m', strtotime($event -> start))}}</td>
                <td>{{$event -> assistido}}</td>
                <td>{{date('H:i', strtotime($event -> start))}}</td>
                <td>{{ $event -> dur }} min</td>
                <td>{{$event -> vag_h}}</td>
                <td>@if(($event -> vag_h)>0)<a href="/novo/{{ $event -> id }}" class="btn btn-success edit-btn"> Agendar </a> @endif
            </tr>
        @endforeach
    </tbody>
    @else
    <p>Você ainda não criou um horario de atendimento. <a href="/novo/create">Criar novo agendamento</a></p>
    @endif
</div>

@endsection