@extends('layouts.main')

@section('title', 'Agendamentos')

@section('content')    
    <p>Ferramenta para conciliação de horarios de agendamentos <br>
    entre a escola e o NAJ. <br></p>
    <a  href="/novo/create"><button >Criar agenda</button></a> <a href="#"><button>Novo agendamento</button></a> <a href="/calendario"><button>Visualizar calendario</button></a> 

    <div id="events-container" class="col-md-12">
        <h2>Próximas vagas livres</h2>

    <div id="cards-container" class="row">
    @foreach($events as $event)
    <div class = "card col-md-4"> <!--Quantidade por linha-->
        <div class="card-body">
            <h5 class="card-date">{{$event -> dia}}</h5>
            <p class="datas"> de {{$event -> start}} <br> até {{$event -> end}}</p>
            <p class="vagas">{{$event -> vag_h}} vagas</p>
            <a href="#" class="btn btn-primary"> Agendar </a>
        </div>
    </div>
    </div>
    @endforeach
    </div>

@endsection  