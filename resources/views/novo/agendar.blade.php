@extends('layouts.main')

@section('title', 'Agendar')

@section('content')    

    <div id="events-container" class="col-md-12">
        <h2>Próximas vagas livres</h2>

    <div id="cards-container" class="">
    @foreach($events as $event)
    <div class = "card col-md-4"> <!--Quantidade por linha-->
        <div class="card-body">
            <h5 class="card-date">{{$event -> dia}}<br>dia {{date('d/m', strtotime($event -> start))}}</h5>
            <p class="datas"> de {{date('H:i', strtotime($event -> start))}} <br> até {{date('H:i', strtotime($event -> end))}}</p>
            <p class="vagas">{{$event -> vag_h}} vagas</p>
            <a href="/novo/{{ $event -> id }}" class="btn btn-secondary"> Agendar </a>
        </div>
    </div>
    </div>
    @endforeach
    @if(count($events) == 0)
        <p>Não há agendamentos disponíveis</p>
    @endif
    </div>

@endsection  