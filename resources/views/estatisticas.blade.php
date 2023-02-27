@extends('layouts.main')

@section('tile', 'Estatisticas')

@section('content')

<div class="container">
    <div class="row align-items-start">
        <div class="col">
            <a style="text-decoration:none" href="{{route('mediacao.agendamentos')}}">
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
            <p class="mx-auto">Assistidos Cadastrados</p>
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
            <p class="mx-auto">Agendamentos Finalizados</p>
            <h3>{{$historicos}}</h3>           
            </article>
        </div>
        </div>
        </a>
    </div>

</div>
    
</div> <br>
    <div class="row mx-5 mb-5">
        <section class="graficos col 12 my-5" >            
          <div class="grafico card z-depth-4">
            <form action="{{route('historico.dashboard')}}">
                <label for="começo"><input type="number" min="2022" max="2099" step="1" value="2023" class="form-control" id="ano" name="ano" placeholder="começo"></label>
                <input type="submit" class="btn btn-warning btn-sm" value="filtrar" >
            </form>
              <h5 class="center"> Atendimentos por mês</h5>
              <canvas id="myChart" width="700" height="350"></canvas>
          </div>           
        </section> 

        <section class="graficos col 12 my-5">            
            <div class="grafico card z-depth-4">
                <h5 class="center"> Pareceres </h5>
                {{--<form action="#">
                    <select name="op" id="op">
                        <option value="1" onclick="tipo(1)">Porcentagem</option>
                        <option value="2" onclick="tipo(2)">Total</option>
                    </select>
                </form>--}}
                <canvas id="myChart2" width="700" height="350"></canvas> 
            </div>            
</div>
@endsection

@push('graficos')
<script>
/* Gráfico 01 */
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [{!!$meses!!}],
        datasets: [{
            label: '2023',
            data: [{{$tot_p_mes}}],
            backgroundColor: [
                'rgba(153, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',                         
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(173, 133, 145, 1)',
                'rgba(129, 173, 181, 1)',
                'rgba(201, 194, 127, 1)',
                'rgba(185, 156, 107, 1)',
                'rgba(129, 173, 181, 1)',                         
                'rgba(228, 153, 105, 1)',
                'rgba(200, 200, 200, 1)'
            ],
            borderColor: [
                'rgba(0, 0, 0, 0.2)',
                'rgba(0, 0, 0, 0.2)',
                'rgba(0, 0, 0, 0.2)',
                'rgba(0, 0, 0, 0.2)',
                'rgba(0, 0, 0, 0.2)',
                'rgba(0, 0, 0, 0.2)',
                'rgba(0, 0, 0, 0.2)',
                'rgba(0, 0, 0, 0.2)',
                'rgba(0, 0, 0, 0.2)',
                'rgba(0, 0, 0, 0.2)',
                'rgba(0, 0, 0, 0.2)',
                'rgba(0, 0, 0, 0.2)'
            ],
           borderWidth: 1, 
           maxBarThickness: 50,
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
        labels: ['Acordo inviável - {{$acordo_inviavel_p}}', 'Parte não compareceu - {{$nao_compareceu_p}}', 'Acordo realizado - {{$acordo_realizado_p}}', 'Processo judicializado - {{$processo_judicializado_p}}'],
        datasets: [{
            label: 'Pareceres',
            data: [
                {{$acordo_inviavel}}, 
                {{$nao_compareceu}} ,
                {{$acordo_realizado}},
                {{$processo_judicializado}}
            ],
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

    
