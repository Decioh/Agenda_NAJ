@extends('layouts.main')

@section('title', 'Informações assistido')

@section('content')    

<h3 class="mt-3">Informações assistido</h3>
<p>
    Nome: {{$assistido -> nome}}<br>
    nasc: {{date('d/m/Y', strtotime($assistido -> nasc))}}<br>
    @php
    $cpf = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $assistido -> cpf);
    $tel = preg_replace("/(\d{0})(\d{2})(\d{5})(\d{4})/", "\$1(\$2)\$3-\$4", $assistido -> telefone);
    @endphp
    cpf: {{$cpf}}<br>
    email: {{$assistido -> email}}<br>
    telefone: {{$tel}}<br>
    Informações adicionais: {{$assistido -> info}}
</p>
<h2>Agendamentos do assistido</h2>
@if(count($agenda)>0)    
    @foreach( $agenda as $agenda)
    <a href="{{ route('assistido.edit', $assistido -> id) }}" class="btn btn-success edit-btn">{{$agenda->dia}} -
        {{date('d/m/y H:i', strtotime($agenda -> start))}}</a>
    @endforeach
@else
<p>Assistido sem agendamentos</p>
@endif

@endsection