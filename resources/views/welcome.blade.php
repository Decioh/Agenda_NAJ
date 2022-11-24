@extends('layouts.main')

@section('title', 'Agendamentos')

@section('content')    

    <p class="align-middle">Ferramenta para conciliação de horarios de agendamentos <br>
    entre a escola e o NAJ. <br></p>
    <a  href="{{url ('mediacao/criar_agenda')}}"><button class="btn btn-secondary">Criar agenda</button></a> <a href="{{url ('mediacao/agendamentos')}}"><button class="btn btn-secondary">Agendar</button></a> <a href="{{url ('calendario')}}"><button class="btn btn-secondary">Visualizar calendario</button></a> 

    <!--<div id="search-container" class="col-md-12">
        <h3>Procurar agendamento existente:</h3>
        <form action="/" method="GET">
            <input type="text" id="search" name="search" class="form-control" placeholder="Procurar agendamento">
        </form>
    </div>-->

@endsection  