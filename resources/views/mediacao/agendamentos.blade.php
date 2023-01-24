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
    @if ((Auth::user()->user_type) == 1)<a  href="{{url ('/mediacao/criar_agenda')}}"><button class="btn btn-dark ">Disponibilizar novo horario na agenda</button></a><br>@endif
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
                <a href="#"class="btn btn-success my-1"> {{date('H:i', strtotime($agenda->start))}} - {{$agenda->vag_h}} </a>
            @else 
                @if(($agenda -> assistido_id) == null)
                    <a href="#"class="btn btn-primary my-1"> {{date('H:i', strtotime($agenda->start))}} - {{$agenda->vag_h}} </a>
                @else
                    @if(($agenda->Status)==2) <a href="{{route('assistido.info',$agenda->Assistido-> id)}}"class="btn btn-secondary my-1">
                    <abbr class="text-decoration-none my-1" title="{{$agenda->Assistido->nome}}">{{date('H:i', strtotime($agenda->start))}}
                    @elseif(($agenda->Status)==1) <a href="{{route('assistido.info',$agenda->Assistido->id)}}"class="btn btn-warning my-1">
                    <abbr class="text-decoration-none my-1" title="{{$agenda->Assistido->nome}}">{{date('H:i', strtotime($agenda->start))}}    
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
                <a href="#"class="btn btn-success my-1"> {{date('H:i', strtotime($agenda->start))}} - {{$agenda->vag_h}} </a>
            @else
            @if(($agenda->Status)==2) <a href="{{route('assistido.info',$agenda->Assistido-> id)}}"class="btn btn-secondary my-1">
                <abbr class="text-decoration-none my-1" title="{{$agenda->Assistido->nome}}">{{date('H:i', strtotime($agenda->start))}}
            @elseif(($agenda->Status)==1) <a href="{{route('assistido.info',$agenda->Assistido-> id)}}"class="btn btn-warning my-1">
                <abbr class="text-decoration-none my-1" title="{{$agenda->Assistido->nome}}">{{date('H:i', strtotime($agenda->start))}}
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
            <p>Ainda não existe um horario de atendimento.</p>
        @endif
    </div>
        <div class="mx-auto" >
         {{--$agendas->links()--}}
        </div>
@endsection