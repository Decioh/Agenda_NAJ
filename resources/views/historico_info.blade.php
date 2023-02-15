
@extends('layouts.main')

@section('title', 'Informações assistido')

@section('content')  

<h3 class="my-5">Historico do atendimento:</h3>

@foreach($agendas as $agenda)
    <div class="card mx-auto my-5" style="width: 23rem;">
        <div class="row d-flex justify-content-center">
        <div class="card-body">
          <h5 class="card-title">{{$agenda->dia}}</h5>
          <h6 class="card-subtitle mb-2 text-muted">{{date('d/m/y H:i', strtotime($agenda -> start))}}</h6>
          <p class="card-text my-2">Informações do agendamento:</p><p>{{$agenda->info}}</p>
            @foreach($historico as $historico)
                <span class="text"><p>Status: {{$historico->parecer}}{{--<ion-icon class="ion-icon text-success mx-1" name="checkmark-circle"></ion-icon></p>--}}</span>
                <p class="card-subtitle my-1 text-muted">Informações:</p><p> {{$historico->info}}</p>
            @endforeach
            <p class="card-subtitle my-1 text-muted">Partes envolvidas:</p>
            @foreach($assistidos as $assistido)
                <p>{{$loop->iteration.'. '. $assistido->nome}} <a href="{{route('assistido.info', $assistido-> id)}}"class="btn btn-secondary btn-sm"> info </a></p>
            @endforeach
        </div>
    </div>
@endforeach
@endsection