@extends('layouts.main')

@section('tile', 'Estatisticas')

@section('content')
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>   

 
<div class="container">
        <div class="row align-items-start">
          <div class="col">
            <a style="text-decoration:none" href="{{route('historico.index')}}">
            <div class="card mx-auto my-5" style="width: 20rem;">
                <article class="bg-gradient-green rounded row d-flex ">
                  <i class="material-icons my-3">perm_contact_calendar</i>
                  <p class="mx-auto">Agendamentos</p>
                  <h3>{{$agendamentos}}</h3>       
                </article>
            </div>
            </a>
          </div>
          <div class="col">
            <a style="text-decoration:none" href="{{route('assistido.list')}}">
            <div class="card mx-auto my-5" style="width: 20rem;">
                <article class="bg-gradient-blue rounded row d-flex ">
                <i class="material-icons my-3">face</i>
                <p class="mx-auto">Assistidos</p>
                <h3> {{$assistidos}} </h3>           
              </article>
              </div>
            </a>
          </div>
          <div class="col">
            <a style="text-decoration:none" href="{{route('historico.index')}}">
            <div class="card mx-auto my-5" style="width: 20rem;">
                <article class="bg-gradient-orange rounded row d-flex ">
                <i class="material-icons my-3">done_all</i>
                <p class="mx-auto">Acordos realizados</p>
                <h3>{{$historicos}}</h3>           
              </article>
              </div>
            </div>
            </a>
        </div>

    </div>


    <div class="row mx-5 my-5">
        <section class="graficos col s12 my-5" >            
          <div class="grafico card z-depth-4">
              <h5 class="center"> Atendimentos por mês</h5>
              <canvas id="myChart" width="400" height="200"></canvas>
          </div>           
        </section> 
        
        <section class="graficos col s12 my-5">            
            <div class="grafico card z-depth-4">
                <h5 class="center"> Pareceres </h5>
                <canvas id="myChart2" width="400" height="200"></canvas> 
            </div>            
            
</div>

@endsection

@push('graficos')
<script>
/* Gráfico 01 */
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Janeiro', 'Feveiro', 'Março', 'Abril'],
        datasets: [{
            label: '2020',
            data: [0, 0, 0, {{$agendamentos}}],
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',                         
                'rgba(255, 159, 64, 1)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',                     
                'rgba(255, 159, 64, 1)'
            ],
           borderWidth: 1, 
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

/* Gráfico 02 */
var ctx = document.getElementById('myChart2');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Acordo inviável', 'Parte não compareceu', 'Acordo realizado', 'Processo judicializado'],
        datasets: [{
            label: 'Visitas',
            data: [12, 1, 3, 5],
            backgroundColor: [
                'rgba(255, 99, 132)',
                'rgba(54, 162, 235)',                         
                'rgba(255, 159, 64)',
                'rgba(150, 159, 64)'
            ]
        }]
    }
});
</script>
@endpush

    
