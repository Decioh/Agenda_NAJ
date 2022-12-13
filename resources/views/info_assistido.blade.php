@extends('layouts.main')

@section('title', 'Meus agendamentos')

@section('content')    

<p>Dados do assistido: {{$assistido -> nome}}</p>
<p>Agendado para: {{$agenda -> start}}</p>

@endsection