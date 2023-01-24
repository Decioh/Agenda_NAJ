@extends('layouts.main')

@section('title', 'Agendamento')

@section('content')    

    <div class="container-fluid">
        <div class="row">
            @if(session('msg'))
            <p class="msg"> {{session('msg')}}</p>
            @endif
        </div>
    </div>

    <div class="col-md10 offset-md-1 dashboard-title-container" style="margin-right: 160px">
        <h2>Agendando assistido</h2>

        <a href="{{route('assistido.novo')}}" class="btn btn-secondary edit-btn">Cadastrar outro assistido</a>
    </div>
        <p>Ou, continue e escolha um horário de atendimento...</p>
    <div class="col-md10 offset-md-1 dashboard-title-container pb-5" style="margin-right: 160px">
    @php
    $i = 1;
    @endphp
        @if(count($agendas) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Dia</th>
                    <th scope="col">Horários</th>
                </tr>
            </thead>
        
        <tbody>

    @foreach($agendas as $agenda)
        @if($loop->first)
            @php 
                $day = date('d/m', strtotime($agenda -> start));
                $l_start = $agenda -> start;
                $l_assistido = $agenda -> assistido_id;
            @endphp
            <tr>
                <th scope="row">{{ $i }}</th>
                <td>{{$agenda->dia}} - {{date('d/m', strtotime($agenda->start))}}</td>
                <td> @if(($agenda -> assistido_id) == null)
                    <a href="{{route('assistido.agendar', [$assistido_id, 'agenda_id'=> $agenda->id]) }}" class="btn btn-success edit-btn"> {{date('H:i', strtotime($agenda->start))}} </a>
                @endif                
        @endif
        @if($day != date('d/m', strtotime($agenda -> start)))                           <!--Abrimos nova linha, caso seja um novo dia-->
            @php $i+=1;@endphp                                                      <!--Contagem de dias-->
                </td>                               
            </tr>
            <tr>
                <th scope="row">{{$i}}</th>
                <td>{{$agenda->dia}} - {{date('d/m', strtotime($agenda->start))}}</td>
                <td>
        @endif
        @if($l_start != $agenda -> start || $l_assistido != $agenda->assistido_id)  <!--Para mostrar apenas um evento por horario-->
            @if(($agenda -> assistido_id) == null)
                <a href="{{route('assistido.agendar', [$assistido_id, 'agenda_id'=> $agenda->id]) }}" class="btn btn-success edit-btn"> {{date('H:i', strtotime($agenda->start))}} </a>
            @endif   
        @endif
        @php 
            $l_start = $agenda -> start;
            $l_assistido = $agenda -> assistido_id;
            $day = date('d/m', strtotime($agenda -> start)); 
        @endphp 
    @endforeach
                </td>
            </tr>
        </tbody>
    </div>
    @endif
        <div class="mx-auto" >
            {{$agendas->links()}}
        </div>
@endsection