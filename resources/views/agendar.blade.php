@extends('layouts.main')

@section('title', 'Agendar')

@section('content')  

    <a class="btn btn-dark mt-5" href="{{ route('assistido.list')}}">Pesquisar/Cadastrar assistido</a>
    
    <div id="events-container" class="col-md-12">
        <h2>Próximas vagas e horários</h2>
        

    @foreach($agendas as $agenda)
        @if($loop->first)                                                   <!-- Se for o primeiro loop, já criamos o card com o dia-->
            @php $day = date('d/m', strtotime($agenda -> start)) @endphp    <!-- Igualando o primeiro dia com o dia atual, para comparar nos próximos loops-->
            @php 
                $l_start = $agenda -> start;
                $l_assistido = $agenda -> assistido_id;
            @endphp
                <div id="cards-container">                                  <!-- Container para os cards-->
                <div class="row d-flex justify-content-center">
                    <div class = "card col-md-4">
                        <div class="card-body">
                            {{$agendas->links()}}
                            <h5 class="card-date">{{$agenda -> dia}}<br>dia {{date('d/m', strtotime($agenda -> start))}}</h5><!-- Imprimindo o dia e mês-->
                            @if (isset($agenda -> assistido_id))
                                <p class="datas">Agendamento: {{date('H:i', strtotime($agenda -> start))}}<br>{{$agenda->Assistido->nome }} @if(($agenda->Status)==2) <ion-icon name="checkmark-done-outline"></ion-icon>@elseif(($agenda->Status)==1) <ion-icon name="checkmark-outline"></ion-icon> @endif<br>  
                                    <a href="{{route('assistido.info',$agenda->Assistido-> id)}}" class="btn btn-secondary"> info </a>
                                </p>
                            @else
                                <p class="datas"> de {{date('H:i', strtotime($agenda -> start))}} <br> até {{date('H:i', strtotime($agenda -> end))}} <br>  
                                    <a href="#" class="btn btn-success"> {{$agenda -> vag_h}} vaga(s) </a>
                                </p>
                            @endif
                            
        @else
            @if($l_start != $agenda -> start || $l_assistido != $agenda -> assistido_id)  <!--Para mostrar apenas um evento por horario-->
                    @if($day != date('d/m', strtotime($agenda -> start)))    <!-- Se for um novo dia, criaremos outro card com o próximo dia-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="cards-container">
                        <div class="row d-flex justify-content-center">
                            <div class = "card col-md-4">
                                <div class="card-body">
                                    <h5 class="card-date">{{$agenda -> dia}}<br>dia {{date('d/m', strtotime($agenda -> start))}}</h5>
                    @endif
                @if($agenda->vag_h>0)
                    @if (isset($agenda -> assistido_id))
                    <p class="datas">Agendamento: {{date('H:i', strtotime($agenda -> start))}}<br>Assistido: {{$agenda->Assistido->nome }} @if(($agenda->Status)==2) <ion-icon name="checkmark-done-outline"></ion-icon>@elseif(($agenda->Status)==1) <ion-icon name="checkmark-outline"></ion-icon> @endif<br>  
                        
                        <a href="{{route('assistido.info',$agenda->Assistido-> id)}}" class="btn btn-secondary"> info </a>
                    </p>
                    @else
                    <p class="datas"> de {{date('H:i', strtotime($agenda -> start))}} <br> até {{date('H:i', strtotime($agenda -> end))}} <br>  
                        <a href="" class="btn btn-success"> {{$agenda -> vag_h}} vaga(s) </a>
                    </p>
                    @endif
                @endif
                    @php 
                        $day = date('d/m', strtotime($agenda -> start)); 
                        $l_start = $agenda -> start;
                        $l_assistido = $agenda -> assistido_id;
                    @endphp
            @endif
        @endif    
    @endforeach

    @if(count($agendas) == 0)
        <p>Não há agendamentos disponíveis</p>
    @endif
    


@endsection  