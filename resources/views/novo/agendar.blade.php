@extends('layouts.main')

@section('title', 'Agendar')

@section('content')    

    <div id="events-container" class="col-md-12">
        <h2>Próximas vagas livres</h2>

    
    @foreach($events as $event)
    <div id="cards-container">
    <div class="row d-flex justify-content-center">
        <div class = "card col-md-4">
            <div class="card-body">
                <h5 class="card-date">{{$event -> dia}}<br>dia {{date('d/m', strtotime($event -> start))}}</h5>
                <p class="datas"> de {{date('H:i', strtotime($event -> start))}} <br> até {{date('H:i', strtotime($event -> end))}}</p>
                <p class="vagas">{{$event -> vag_h}} vagas</p>
                <a href="edit/{{ $event -> id }}" class="btn btn-secondary"> {{date('H:i', strtotime($event -> start))}} </a>
            </div>
        </div>
    </div>
    </div>
    @endforeach
    @if(count($events) == 0)
        <p>Não há agendamentos disponíveis</p>
    @endif
    </div>


@endsection  