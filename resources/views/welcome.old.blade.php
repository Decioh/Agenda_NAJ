@extends('layouts.main')

@section('title', 'Agendamentos')

@section('content')    

    <p class="align-middle">Ferramenta para conciliação de horarios de agendamentos <br>
    entre a escola e o NAJ. <br></p>
    <a  href="{{url ('mediacao/criar_agenda')}}"><button class="btn btn-secondary">Criar agenda</button></a> <a href="{{url ('mediacao/agendamentos')}}"><button class="btn btn-secondary">Agendar</button></a> <a href="{{url ('calendario')}}"><button class="btn btn-secondary">Visualizar calendario</button></a> 


@endsection  