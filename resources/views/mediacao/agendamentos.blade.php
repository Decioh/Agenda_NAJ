@extends('layouts.main')

@section('title', 'Meus agendamentos')

@section('content')    

<div class="col-md10 offset-md-1 dashboard-title-container" style="margin-right: 160px">
    <h2>Meus agendamentos</h2>
</div>
<div style="margin-bottom: 50px">
<a  href="{{url ('/mediacao/criar_agenda')}}"><button class="btn btn-secondary">Criar agenda</button></a>
</div>
<div class="col-md10 offset-md-1 dashboard-title-container pb-5" style="margin-right: 160px">
@php
$i = 1;
@endphp
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
            @if($loop -> first)
                @php
                    $l_start = $event -> start;
                    $l_assistido = $event -> assistido;
                @endphp
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{$event -> dia}} - {{date('d/m', strtotime($event -> start))}}</td>
                    <td>{{$event -> assistido}}</td>
                    <td>{{date('H:i', strtotime($event -> start))}}</td>
                    <td>{{ $event -> dur }} min</td>
                    <td>{{$event -> vag_h}}</td>
                    <td>@if(($event -> assistido) == 'Horário vago')<a href="/cadastroassistido/{{ $event -> id }}" class="btn btn-success edit-btn"> Agendar </a>@else <a href=""class="btn btn-danger edit-btn"> Editar </a> <a href=""class="btn btn-secondary edit-btn"> Info </a>@endif
                </tr>
                @php $i+=1;@endphp
            @endif
            @if($l_start != $event -> start || $l_assistido != $event -> assistido)
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{$event -> dia}} - {{date('d/m', strtotime($event -> start))}}</td>
                    <td>{{$event -> assistido}}</td>
                    <td>{{date('H:i', strtotime($event -> start))}}</td>
                    <td>{{ $event -> dur }} min</td>
                    <td>@if($event -> vag_h == 0) - @else{{$event -> vag_h}}@endif</td>
                    <td>@if(($event -> assistido) == 'Horário vago')<a href="/cadastroassistido/{{ $event -> id }}" class="btn btn-success edit-btn"> Agendar </a>@else <a href=""class="btn btn-danger edit-btn"> Editar </a> <a href=""class="btn btn-secondary edit-btn"> Info </a>@endif
                </tr>
                @php $i+=1;@endphp
                @php
                        $l_start = $event -> start;
                        $l_assistido = $event -> assistido;
                @endphp
            @endif
        @endforeach
    </tbody>
    @else
        <p>Você ainda não criou um horario de atendimento. <a href="{{url ('novo/create')}}">Criar novo agendamento</a></p>
    @endif
</div>

@endsection