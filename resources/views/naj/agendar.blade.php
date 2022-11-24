@extends('layouts.main')

@section('title', 'Agendar')

@section('content')    

    <div id="events-container" class="col-md-12">
        <h2>Próximas vagas livres</h2>

    
    @foreach($events as $event)
        @if($loop->first)                                                   <!-- Se for o primeiro loop, já criamos o card com o dia-->
            @php $day = date('d/m', strtotime($event -> start)) @endphp <!-- Igualando o primeiro dia com o dia atual, para comparar nos próximos loops-->
                      
            @php 
                $l_start = $event -> start;
                $l_assistido = $event -> assistido;
            @endphp 
            
                <div id="cards-container">                                      <!-- Container para os cards-->
                <div class="row d-flex justify-content-center">
                    <div class = "card col-md-4">
                        <div class="card-body">
                            <h5 class="card-date">{{$event -> dia}}<br>dia {{date('d/m', strtotime($event -> start))}}</h5><!-- Imprimindo o dia e mês-->
            
        @endif
        @if($l_start != $event -> start || $l_assistido != $event -> assistido)
            @if($day != date('d/m', strtotime($event -> start)))    <!-- Se for um novo dia, criaremos outro card com o próximo dia-->
                        </div>
                    </div>
                </div>
            </div>
            <div id="cards-container">
                <div class="row d-flex justify-content-center">
                    <div class = "card col-md-4">
                        <div class="card-body">
                            <h5 class="card-date">{{$event -> dia}}<br>dia {{date('d/m', strtotime($event -> start))}}</h5>
                            @endif
                           <!-- <p class="datas"> de {{date('H:i', strtotime($event -> start))}} <br> até {{date('H:i', strtotime($event -> end))}} <br>  Imprimindo o horario de atendimento-->
            
                @if (($event -> assistido) == "Horário vago")                           <!-- Se o horario estiver vago, habilita link para cadastrar assistido -->
                    <p class="datas"> de {{date('H:i', strtotime($event -> start))}} <br> até {{date('H:i', strtotime($event -> end))}} <br>
                    <a href="/novo/{{ $event -> id }}" class="btn btn-success"> {{$event -> vag_h}} vaga(s) </a></p>

                @endif
        
                @php 
                    $day = date('d/m', strtotime($event -> start))
                    $l_start = $event -> start;
                    $l_assistido = $event -> assistido;
                @endphp 
        @endif
    @endforeach
    @if(count($events) == 0)
        <p>Não há agendamentos disponíveis</p>
    @endif
    


@endsection  