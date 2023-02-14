
@extends('layouts.main')

@section('title', 'Histórico de atendimentos')

@section('content')  
<div id="search-container" class="col-md-12 justify-content-center">
    <h2>Buscar Histórico</h2>
    <form action="{{route('assistido.list')}}" method="GET">
        <input type="text" id="search" name="search" placeholder="Procure pelo Nome ou CPF"> <br>
        <button type="submit" class="btn btn-warning btn-sm mt-1">Pesquisar</button>
    </form>
</div>
@if(count($historicos)>0)
 
<div class="listHistoricos">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Data</th>
                <th scope="col">Partes</th>
                <th scope="col">Parecer</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
    @foreach ($historicos as $historicos)
            <tbody>
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{date('d/m/Y', strtotime($historicos->start))}}</td>
                    <td>{{$historicos->agenda_id}}</td>
                    <td>{{$historicos->parecer}}</td>
                    <td>
                        <a href="#"class="btn btn-secondary btn-sm"> info </a>
                    </td>
                </tr>
            </tbody>
        
    @endforeach
</div>
        @else
        <p>Ainda não existe um histórico</p>
    @endif 

@endsection