@extends('layouts.main')

@section('title', 'Agendas sem parecer')

@section('content')    
<div class="col-md10 offset-md-1 dashboard-title-container pb-5 mt-5" style="margin-right: 160px">
    @php
    $i = 1;
    @endphp

@if(count($agendas) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Informações</th>
                <th scope="col">Dia</th>
                <th scope="col">Agendamento</th>
            </tr>
        </thead>
    <tbody>
    @foreach($agendas as $agenda)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$agenda->info}}</th>
            <td>{{$agenda->dia}} - {{date('d/m', strtotime($agenda->start))}}</td>
            <td> <a href="{{route('historico.info',$agenda->id)}}"class="btn btn-secondary btn-sm"> Info </a> <a href="{{route('historico.create',$agenda->id)}}" class="btn btn-warning btn-sm">Adicionar parecer</a></td>                      
            </tr>
    </tbody>
    @endforeach
    @else
        <p>Todos os Agendamentos antigos possuem desfecho! <ion-icon name="happy-outline"></ion-icon> </p>
    @endif
</div>
    <div class="mx-auto" >
     {{--$agendas->links()--}}
</div>
@endsection