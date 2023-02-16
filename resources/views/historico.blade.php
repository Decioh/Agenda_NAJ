
@extends('layouts.main')

@section('title', 'Histórico de atendimentos')

@section('content')  

<div id="search-container" class="col-md-12 justify-content-center">
    <h2>Buscar Histórico</h2>
    <form action="{{route('historico.index')}}" method="GET">
        <input type="text" id="search" name="search" placeholder="Procure pelo Nome do assistido"> <br>
        <button type="submit" class="btn btn-warning btn-sm mt-1">Pesquisar</button><a class="btn btn-secondary btn-sm mx-1 mt-1" href="{{route('historico.index')}}">limpar</a>
    </form>
</div>
<div class="container-fluid">
    <div class="row">
        @if(session('msg'))
        <p class="msg"> {{session('msg')}}</p>
        @endif
    </div>
</div>
@if(count($historicos)>0)
 
<div class="listHistoricos">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Data</th>
                {{--<th scope="col">Partes</th>--}}
                <th scope="col">Horario</th>
                <th scope="col">Parecer</th>
                <th scope="col">Informações</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
    @foreach ($historicos as $historicos)
            <tbody>
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{date('d/m/Y', strtotime($historicos->start))}}</td>
                    <td>{{date('H:i', strtotime($historicos->start))}}</td>
                    {{--<td>{{$historicos->agenda->Assistido->nome}}</td>--}}
                    <td>{{$historicos->parecer}}</td>
                    <td>{{$historicos->info}}</td>
                    <td>
                        <a href=""class="btn btn-warning btn-sm" data-toggle="modal" data-target="exampleModal"> Partes </a>
                        <a href="{{route('historico.info',$historicos->agenda_id)}}"class="btn btn-secondary btn-sm"> Info </a>
                    </td>
                </tr>
            </tbody>
        
    @endforeach
</div>
        @else
        <p>Ainda não existe um histórico</p>
    @endif 
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="1" role="dialog" aria-labelledby="#exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endsection