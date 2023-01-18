@extends('layouts.main')

@section('title', 'Informações assistido')

@section('content')    

@php
$cpf = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $assistido -> cpf);
$tel = preg_replace("/(\d{0})(\d{2})(\d{5})(\d{4})/", "\$1(\$2)\$3-\$4", $assistido -> telefone);
@endphp

<h3 class="mt-3">Informações assistido</h3>

<p>
    Nome: {{$assistido -> nome}}<br>
    nasc: @if($assistido->nasc != null){{date('d/m/Y', strtotime($assistido -> nasc))}} @else - @endif<br>
    cpf: {{$cpf}}<br>
    email: {{$assistido -> email}}<br>
    telefone: {{$tel}}<br>
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
    <div class="card mx-auto" style="width: 18rem;">
        <div class="row d-flex justify-content-center">
        <div class="card-body">
          <h5 class="card-title">{{$agenda->dia}}</h5>
          <h6 class="card-subtitle mb-2 text-muted">{{date('d/m/y H:i', strtotime($agenda -> start))}}</h6>
          <p class="card-text">Informações do agendamento:<br>
            {{$agenda->info}} </p>
            partes:
            {{$assistido->nome}}<br>
            <a href="{{route('agenda.join',$agenda->id)}}" class="btn btn-dark btn-sm"><abbr title="adicionar parte"><ion-icon name="person-add-outline"></ion-icon></abbr></a>
            <form action="{{ route('agenda.destroy', $assistido->id) }}" method="POST" class="mt-3">
                @csrf
                @method('DELETE')
        @if ((Auth::user()->user_type) == 1)
                @if(($agenda->Status)==2) 
                <a href="{{route('assistido.list',['id'=> $agenda->id])}}"class="btn btn-success btn-sm">Agendamento confirmado</a>
            @elseif(($agenda->Status)==1) 
                <a href="{{route('agenda.edit',['id'=> $agenda->id])}}"class="btn btn-warning btn-sm">Confirmar agendamento</a>
            @endif
        @endif
                <button type="submit" class="btn btn-danger delete-btn btn-sm mt-1">Cancelar agendamento</button>            
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