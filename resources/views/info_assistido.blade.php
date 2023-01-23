
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
{{--<form action="{{ route('assistido.destroy', $assistido->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger delete-btn">Deletar</button>
</form>--}}
    
<h2>Conciliações </h2>

@if(count($agenda)>0)    
    @foreach( $agenda as $agenda)
    <div class="card mx-auto" style="width: 23rem;">
        <div class="row d-flex justify-content-center">
        <div class="card-body">
          <h5 class="card-title">{{$agenda->dia}}</h5>
          <h6 class="card-subtitle mb-2 text-muted">{{date('d/m/y H:i', strtotime($agenda -> start))}}</h6>
          <p class="card-text">Informações do agendamento:<br>
            {{$agenda->info}} </p>
            <b>Partes:</b><br>
            @foreach($assistido_agenda as $assistido_agendas)
                @if($assistido_agendas->agenda_id == $agenda->id)
                {{--<div class="mt-1"><abbr class="text-decoration-none" title="{{($assistido_agendas->nome_assistido)}}">{{ \Illuminate\Support\Str::words($assistido_agendas->nome_assistido, 2, '') }}</abbr> <a href="{{route('delete.parte',['agenda_id'=> $agenda->id,'assistido_id'=>$assistido_agendas->assistido_id])}}" class="btn btn-danger btn-sm"><abbr title="remover parte"><ion-icon name="person-remove-outline"></ion-icon></abbr></a><br></div>--}}
                <div class="mt-1">{{($assistido_agendas->nome_assistido)}} <a href="{{route('delete.parte',['agenda_id'=> $agenda->id,'assistido_id'=>$assistido_agendas->assistido_id])}}" class="btn btn-danger btn-sm"><abbr class="text-decoration-none" title="remover parte"><ion-icon title="false" name="person-remove-outline"></ion-icon></abbr></a><br></div>
                @endif
            @endforeach
            <br>
            <a href="{{route('agenda.nova_parte', $agenda->id)}}" class="btn btn-success btn-sm"><abbr class="text-decoration-none" title="Adicionar parte"><ion-icon title = "false" name="person-add-outline"></ion-icon></abbr></a>
            <form action="{{ route('agenda.destroy', $assistido->id) }}" method="POST" class="mt-3">
                @csrf
                @method('DELETE')
        @if ((Auth::user()->user_type) == 1)
                @if(($agenda->Status)==2) 
                <button href="{{route('agenda.edit',['id'=> $agenda->id])}}"class="btn btn-success btn-sm">Agendamento confirmado</button>
            @elseif(($agenda->Status)==1) 
                <button href="{{route('agenda.edit',['id'=> $agenda->id])}}"class="btn btn-warning btn-sm">Confirmar agendamento</button>
            @endif
                <button type="submit" class="btn btn-danger delete-btn btn-sm mt-1">Cancelar agendamento</button> 
        @endif           
            </form>
        </div>
      </div>
    </div>
        <br>
    @endforeach
@else
<p>Assistido sem agendamentos</p>
@endif

@endsection