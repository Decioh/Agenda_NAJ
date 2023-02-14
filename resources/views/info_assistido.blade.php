
@extends('layouts.main')

@section('title', 'Informações assistido')

@section('content')    

@php
$cpf = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $assistido -> cpf);
$tel = preg_replace("/(\d{0})(\d{2})(\d{5})(\d{4})/", "\$1(\$2)\$3-\$4", $assistido -> telefone);
@endphp

<h3 class="mt-3">Informações assistido</h3>

<p>
    <b>Nome:</b> {{$assistido -> nome}}<br>
    <b>Nasc:</b> @if($assistido->nasc != null){{date('d/m/Y', strtotime($assistido -> nasc))}} @else - @endif<br>
    <b>CPF:</b> {{$cpf}}<br>
    <b>E-mail:</b> {{$assistido -> email}}<br>
    <b>Telefone:</b> {{$tel}}<br>
</p>
<a href="{{ route('assistido.edit', $assistido-> id) }}"class="btn btn-warning btn"> Editar </a>
    
<h2>Conciliações </h2>

@if(count($agenda)>0)    
    @foreach( $agenda as $agenda)
    <div class="card mx-auto mb-5" style="width: 23rem;">
        <div class="row d-flex justify-content-center">
        <div class="card-body">
          <h5 class="card-title">{{$agenda->dia}}</h5>
          <h6 class="card-subtitle mb-2 text-muted">{{date('d/m/y H:i', strtotime($agenda -> start))}}</h6>
          <p class="card-text">Informações do agendamento:<br>
            {{$agenda->info}} </p>
            <b>Partes:</b><br>
            @foreach($assistido_agenda as $assistido_agendas)
                @if($assistido_agendas->agenda_id == $agenda->id)
                <div class="mt-1">{{($assistido_agendas->nome_assistido)}} <a href="{{route('delete.parte',['agenda_id'=> $agenda->id,'assistido_id'=>$assistido_agendas->assistido_id])}}" class="btn btn-danger btn-sm"><abbr class="text-decoration-none" title="remover parte"><ion-icon title="false" name="person-remove-outline"></ion-icon></abbr></a><br></div>
                @endif
            @endforeach
            <br>
            <a href="{{route('agenda.nova_parte', $agenda->id)}}" class="btn btn-success btn-sm"><abbr class="text-decoration-none" title="Adicionar parte"><ion-icon title = "false" name="person-add-outline"></ion-icon></abbr></a>
            <div>
                <form action="{{ route('agenda.destroy', ["id"=>$assistido->id,"agenda_id"=>$agenda->id]) }}" method="POST" class="mt-3">
                    @csrf
                    @method('DELETE')
                    @if ((Auth::user()->user_type) == 1)
                        @if(($agenda->Status)==2) 
                            <a href="{{route('agenda.edit', $assistido_agendas->agenda_id)}}" class="btn btn-success btn-sm">Agendamento confirmado</a>
                        @elseif(($agenda->Status)==1) 
                            <a href="{{route('agenda.edit',$assistido_agendas->agenda_id)}}" class="btn btn-warning btn-sm">Confirmar agendamento</a>
                    @endif
                    <br>
                    <button type="submit" class="btn btn-danger btn-sm mt-1">Cancelar agendamento</button>          
                    <a href="{{route('historico.create',$assistido_agendas->agenda_id)}}" class="btn btn-secondary btn-sm">Adicionar parecer</a>
                </form>
            </div>
            

            
@endif  
        </div>
      </div>
    </div>
        <br>
    @endforeach
@else
<p>Assistido sem agendamentos</p>
@endif

@endsection