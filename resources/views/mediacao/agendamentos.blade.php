@extends('layouts.main')

@section('title', 'Meus agendamentos')

@section('content')    

<div class="container-fluid">
    <div class="row">
        @if(session('msg'))
        <p class="msg"> {{session('msg')}}</p>
        @endif
    </div>
</div>
@if ((Auth::user()->user_type) == 2)
    <h1>Usuario não autorizado</h1>
@else
<div style="margin: 50px">
<a  href="{{url ('/mediacao/criar_agenda')}}"><button class="btn btn-dark ">Disponibilizar novo horario na agenda</button></a><br>
<a class="btn btn-warning mt-5" href="{{ route('assistido.list')}}">Pesquisar/Cadastrar assistido</a>
</div>

<div class="col-md10 offset-md-1 dashboard-title-container" style="margin-right: 160px">
    <h2>Meus agendamentos</h2>
</div>
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
            @if($agenda->vag_h>0)
            <tr>
                <th scope="row">{{ $i }}</th>
                <td>{{$agenda -> dia}} - {{date('d/m', strtotime($agenda -> start))}}</td>
                <td>@if($agenda-> assistido_id != null){{$agenda->Assistido->nome }}@else - @endif</td>
                <td>{{date('H:i', strtotime($agenda -> start))}}</td>
                <td>{{ $agenda -> dur }} min</td>
                <td>@if($agenda -> assistido_id != null) - @else{{$agenda -> vag_h}}@endif</td>
                <td>@if(($agendamentos[($agenda->id-1)]->Status)== 1)<a href="{{ route('agenda.edit', $agenda -> id) }}" class="btn btn-warning edit-btn" >Pendente</a>
                    @elseif(($agendamentos[($agenda->id-1)]->Status)== 2) <a href="{{ route('agenda.edit', $agenda -> id) }}" class="btn btn-success edit-btn" >Confirmado</a>
                    @else Não agendado @endif</td>
                <td>@if(($agenda -> assistido_id) == null)<a href="{{ route('assistido.create', $agenda -> id) }}" class="btn btn-success edit-btn"> Agendar </a>@else <a href="{{ route('assistido.edit', $agenda->Assistido-> id) }}"class="btn btn-warning btn-sm"> Editar </a> <a href="{{route('assistido.info',$agenda->Assistido-> id)}}"class="btn btn-secondary btn-sm"> Info </a>@endif
            </tr>
            @php $i+=1;@endphp
            @endif
        @endif
        @if($l_start != $agenda -> start || $l_assistido != $agenda -> assistido_id)  <!--Para mostrar apenas um evento por horario-->
            @if($agenda->vag_h>0)
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td>{{$agenda -> dia}} - {{date('d/m', strtotime($agenda -> start))}}</td>
                        <td>@if($agenda-> assistido_id != null){{$agenda->Assistido->nome }}@else - @endif</td>
                        <td>{{date('H:i', strtotime($agenda -> start))}}</td>
                        <td>{{ $agenda -> dur }} min</td>
                        <td>@if($agenda -> assistido_id != null) - @else{{$agenda -> vag_h}}@endif</td>
                        <td>@if(($agendamentos[($agenda->id-1)]->Status)== 1)<a href="{{ route('agenda.edit', $agenda -> id) }}" class="btn btn-warning edit-btn" >Pendente</a>
                            @elseif(($agendamentos[($agenda->id-1)]->Status)== 2) <a href="{{ route('agenda.edit', $agenda -> id) }}" class="btn btn-success edit-btn" >Confirmado</a>
                            @else Não agendado @endif</td>
                        <td>@if(($agenda -> assistido_id) == null)<a href="{{ route('assistido.create', $agenda -> id) }}" class="btn btn-success edit-btn"> Agendar</a>@else <a href="{{ route('assistido.edit', $agenda->Assistido-> id) }}"class="btn btn-warning btn-sm"> Editar </a> <a href="{{route('assistido.info',$agenda->Assistido-> id)}}"class="btn btn-secondary btn-sm"> Info </a>@endif
                    </tr>
                    @php $i+=1;@endphp
            @endif
            @php 
                $l_start = $agenda -> start;
                $l_assistido = $agenda -> assistido_id;
            @endphp
        @endif
    @endforeach
    </tbody>

    
    @else
        <p>Você ainda não criou um horario de atendimento.</p>
    @endif
</div>
@endif
    <div class="mt-3 mx-auto" style="width: 210px">
        {{$agendas->links('custom.pagination')}}
    </div>
@endsection