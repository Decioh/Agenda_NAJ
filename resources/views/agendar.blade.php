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
    <div style="margin: 50px">
   {{--@if ((Auth::user()->user_type) == 1)<a  href="{{url ('/mediacao/criar_agenda')}}"><button class="btn btn-dark ">Disponibilizar novo horario na agenda</button></a><br>@endif--}}
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
                    <th scope="col">Horários</th>
                </tr>
            </thead>
        
        <tbody>

    @foreach($agendas as $agenda)
        @if($loop->first)
            @php 
                $day = date('d/m', strtotime($agenda -> start));  //Igualando o primeiro dia com o dia atual, para comparar nos próximos loops
                $l_start = $agenda->start;
                $l_assistido = $agenda->assistido_id;
            @endphp 
            <tr>
                <th scope="row">{{$i}}</th>
                <td>{{$agenda->dia}} - {{date('d/m', strtotime($agenda->start))}}</td>
                <td>@if(($agenda -> assistido_id) == null)
                <a href="#"class="btn btn-success"> {{date('H:i', strtotime($agenda->start))}} - {{$agenda->vag_h}} </a>
            @else 
                @if(($agenda -> assistido_id) == null)
                    <a href="#"class="btn btn-primary"> {{date('H:i', strtotime($agenda->start))}} - {{$agenda->vag_h}} </a>
                @else
                    @if(($agenda->Status)==2) <a href="{{route('assistido.info',$agenda->Assistido-> id)}}"class="btn btn-secondary">
                    <abbr class="text-decoration-none" title="{{$agenda->Assistido->nome}}">{{date('H:i', strtotime($agenda->start))}}
                    @elseif(($agenda->Status)==1) <a href="{{route('assistido.info',$agenda->Assistido->id)}}"class="btn btn-warning">
                    <abbr class="text-decoration-none" title="{{$agenda->Assistido->nome}}">{{date('H:i', strtotime($agenda->start))}}    
                @endif
                </abbr></a>
            @endif     
        @endif     
                
        @endif
        @if($day != date('d/m', strtotime($agenda -> start)))                           <!--Abrimos nova linha, caso seja um novo dia-->  <!--Para mostrar apenas um evento por horario-->
                @php $i+=1;@endphp                                                      <!--Contagem de linhas da tabela-->
                    </td>                               
                </tr>
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$agenda->dia}} - {{date('d/m', strtotime($agenda->start))}}</td>
                    <td>
        @endif
        @if($l_start != $agenda->start || $l_assistido != $agenda->assistido_id)  <!--Para mostrar apenas um evento por horario-->
            @if(($agenda -> assistido_id) == null)
                <a href="#"class="btn btn-success"> {{date('H:i', strtotime($agenda->start))}} - {{$agenda->vag_h}} </a>
            @else
            @if(($agenda->Status)==2) <a href="{{route('assistido.info',$agenda->Assistido-> id)}}"class="btn btn-secondary">
                <abbr class="text-decoration-none" title="{{$agenda->Assistido->nome}}">{{date('H:i', strtotime($agenda->start))}}
            @elseif(($agenda->Status)==1) <a href="{{route('assistido.info',$agenda->Assistido-> id)}}"class="btn btn-warning">
                <abbr class="text-decoration-none" title="{{$agenda->Assistido->nome}}">{{date('H:i', strtotime($agenda->start))}}
        @endif
        </abbr></a>    
        @endif
        @else
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


        @else
            <p>Você ainda não criou um horario de atendimento.</p>
        @endif
    </div>
    {{--@endif--}}
        <div class="mx-auto" >
            {{$agendas->links()}}
        </div>
@endsection
{{--@extends('layouts.main')

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
                                <p class="datas">Agendado: {{date('H:i', strtotime($agenda -> start))}}<br>{{$agenda->Assistido->nome }} @if(($agenda->Status)==2) <ion-icon name="checkmark-done-outline"></ion-icon>@elseif(($agenda->Status)==1) <ion-icon name="checkmark-outline"></ion-icon> @endif<br>  
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
                    <p class="datas">Agendado: {{date('H:i', strtotime($agenda -> start))}}<br>Assistido: {{$agenda->Assistido->nome }} @if(($agenda->Status)==2) <ion-icon name="checkmark-done-outline"></ion-icon>@elseif(($agenda->Status)==1) <ion-icon name="checkmark-outline"></ion-icon> @endif<br>  
                        
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
    


@endsection  --}}