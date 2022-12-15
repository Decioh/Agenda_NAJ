@extends('layouts.main')

@section('title', 'Agendar')

@section('content')  

    
    
    <div id="search-container" class="col-md-12 justify-content-center">
        <h2>Buscar assistido</h2>
        <form action="/" method="GET">
            <input type="text" id="search" name="search" placeholder="Procure pelo Nome ou CPF"> <br>
            <button type="submit" class="btn btn-secondary btn-sm mt-1">Pesquisar</button>
        </form>
    @if(isset($search)){
        <p>Buscando por {{$search}}</p>
        @forelse ($assistidos as $assistidos)

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Nascimento</th>
                    <th scope="col">Cpf</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">{{ $loop }}</th>
                    <td>{{$assistido -> nome}}</td>
                    <td>{{$assistido -> nasc}}</td>
                    <td>{{$assistido -> cpf}}</td>
                    <td>{{$assistido -> email}}</td>
                    <td>{{$assistido -> telefone}}</td>
                    <td><a href="{{ route('assistido.edit', $assistido-> id) }}"class="btn btn-warning btn-sm"> Editar </a></td>
                </tr>
            </tbody>
        @empty
            <p>Não foi encontrado um assistido com esse nome/cpf, <a href="#"class="btn btn-warning btn-sm"> Cadastrar assistido </a></p>
        @endforelse
    }   
    @endif
    </div>
    <div id="events-container" class="col-md-12">
        <h2>Próximas vagas livres</h2>
    
    @foreach($agendas as $agenda)
        @if($loop->first)                                                   <!-- Se for o primeiro loop, já criamos o card com o dia-->
            @php $day = date('d/m', strtotime($agenda -> start)) @endphp <!-- Igualando o primeiro dia com o dia atual, para comparar nos próximos loops-->
                 
            @php 
                $l_start = $agenda -> start;
                $l_assistido = $agenda -> assistido_id;
            @endphp
            
                <div id="cards-container">                                      <!-- Container para os cards-->
                <div class="row d-flex justify-content-center">
                    <div class = "card col-md-4">
                        <div class="card-body">
                            <h5 class="card-date">{{$agenda -> dia}}<br>dia {{date('d/m', strtotime($agenda -> start))}}</h5><!-- Imprimindo o dia e mês-->
                            @if (isset($agenda -> assistido_id))
                                <p class="datas">Agendamento: {{date('H:i', strtotime($agenda -> start))}}<br>Assistido: {{$agenda->Assistido->nome }} <br>  
                                    <a href="{{ route('assistido.edit', $agenda->Assistido-> id) }}" class="btn btn-primary"> editar </a>
                                    <a href="{{route('assistido.info',$agenda->Assistido-> id)}}" class="btn btn-secondary"> info </a>
                                </p>
                            @else
                                <p class="datas"> de {{date('H:i', strtotime($agenda -> start))}} <br> até {{date('H:i', strtotime($agenda -> end))}} <br>  
                                    <a href="{{ route('assistido.create', $agenda -> id) }}" class="btn btn-success"> {{$agenda -> vag_h}} vaga(s) </a>
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
                               {{--<p class="datas"> de {{date('H:i', strtotime($agenda -> start))}} <br> até {{date('H:i', strtotime($agenda -> end))}} <br> <!--Imprimindo o horario de atendimento-->--}}
                @if($agenda->vag_h>0)
                    @if (isset($agenda -> assistido_id))
                    <p class="datas">Agendamento: {{date('H:i', strtotime($agenda -> start))}}<br>Assistido: {{$agenda->Assistido->nome }} <br>  
                        <a href="{{ route('assistido.edit', $agenda->Assistido-> id) }}" class="btn btn-primary"> editar </a>
                        <a href="{{route('assistido.info',$agenda->Assistido-> id)}}" class="btn btn-secondary"> info </a>
                    </p>
                    @else
                    <p class="datas"> de {{date('H:i', strtotime($agenda -> start))}} <br> até {{date('H:i', strtotime($agenda -> end))}} <br>  
                        <a href="{{ route('assistido.create', $agenda -> id) }}" class="btn btn-success"> {{$agenda -> vag_h}} vaga(s) </a>
                    </p>
                    @endif
                @endif
                            
                    @php $day = date('d/m', strtotime($agenda -> start))@endphp
                @php 
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