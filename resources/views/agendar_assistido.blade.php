@extends('layouts.main')

@section('title', 'Agendar')

@section('content')  

@php
    $i = 1;
@endphp
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Dia</th>
                <th scope="col">Assistido</th>
                <th scope="col">Horario</th>
                <th scope="col">Duração</th>
                <th scope="col">Vagas</th>
                <th scope="col">Status</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
    
    <tbody>
    
    @foreach($agendas as $agenda)
        @if($loop->first)
            @php 
                $l_start = $agenda -> start;
                $l_assistido = $agenda -> assistido_id;
            @endphp
            @if(($agenda->assistido_id)==null)
                <tr>
                    <th scope="row">{{ $loop->iteration}}</th>
                    <td>{{$agenda -> dia}} - {{date('d/m', strtotime($agenda -> start))}}</td>
                    <td> - </td>
                    <td>{{date('H:i', strtotime($agenda -> start))}}</td>
                    <td>{{ $agenda -> dur }} min</td>
                    <td>{{$agenda -> vag_h}}</td>
                    <td> Não agendado </td>
                    <td><a href="{{route('assistido.agendar', [$assistido_id, 'agenda_id'=> $agenda->id]) }}" class="btn btn-success edit-btn"> Agendar </a>
                </tr>
                @php $i+=1;@endphp
            @endif
        @endif
        @if($l_start != $agenda -> start || $l_assistido != $agenda -> assistido_id)  <!--Para mostrar apenas um evento por horario-->
            @if(($agenda->assistido_id)==null)
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{$agenda -> dia}} - {{date('d/m', strtotime($agenda -> start))}}</td>
                    <td> - </td>
                    <td>{{date('H:i', strtotime($agenda -> start))}}</td>
                    <td>{{ $agenda -> dur }} min</td>
                    <td>{{$agenda -> vag_h}}</td>
                    <td>Não agendado</td>
                    <td><a href="{{route('assistido.agendar', [$assistido_id, 'agenda_id'=> $agenda->id]) }}" class="btn btn-success edit-btn"> Agendar </a>
                </tr>
                @php 
                    $i+=1;
                    $l_start = $agenda -> start;
                    $l_assistido = $agenda -> assistido_id;
                @endphp
            @endif
        @endif           
    @endforeach
    </tbody>
</div>
<div class="mt-3 mx-auto" style="width: 210px">
    {{$agendas->links('pagination::bootstrap-4')}}
</div>
@endsection