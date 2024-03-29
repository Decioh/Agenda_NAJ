
@extends('layouts.main')

@section('title', 'Agendamentos')

@section('content')

<!DOCTYPE html>
<html>
<head>
    
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="{{ asset('js/fullcalendar/pt-br.js') }}"></script>
</head>
<body>
</div>
<div class="container-fluid">
     <div class="row">
         @if(session('msg'))
         <p class="msg"> {{session('msg')}}</p>
         @endif
     </div>
</div>
<div class="container">
    <br />
    <h1 class="text-center text-primary"><u></u></h1>
    <br />

    <div id="calendar"></div>


<script>

$(document).ready(function () {

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    var calendar = $('#calendar').fullCalendar({
        editable:true,
        eventLimit:true,
        header:{
            left:'prev,next,today',
            center:'title',
            right:'month,agendaWeek,agendaDay',
            weekends: false
        },
        /*Horarios disponíveis:*/
        businessHours:[
        {
            start: '09:00', // Início dos atendimentos;
            end: '12:00', // Fim dos atendimentos;
            dow: [1, 2, 3, 4, 5], // dias da semana( começa no domingo[0] e vai até sabado[6]);
        },
        {
            start: '13:00', //  Início dos atendimentos;
            end: '18:00', // Fim dos atendimentos;
            dow: [1, 2, 3, 4, 5], // dias da semana( começa no domingo[0] e vai até sabado[6]);
        }],
        
        agendas:'/calendario',
        selectable:true,
        selectHelper: true,
        select:function(start, end, allDay)
        {
            var agenda = prompt('Tipo de atendimento:');

            if(agenda)
            {
                var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm');

                var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm');

                $.ajax({
                    url:"/calendario/action",
                    type:"POST",
                    data:{
                        agenda: $agenda->Assistido->nome,
                        start: start,
                        end: end,
                        type: 'add'
                    },
                    success:function(data)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Agendamento criado com sucesso!");
                    }
                })
            }
        },
    
        editable:true,
        
        eventResize: function(agendas, delta)
        {
            var start = $.fullCalendar.formatDate(agendas.start, 'DD-MM-Y HH:mm');
            var end = $.fullCalendar.formatDate(agendas.end, 'DD-MM-Y HH:mm');
            var assistido = agenda.assistido_id;
            var id = agendas.id;
            $.ajax({
                url:"/calendario/action",
                type:"POST",
                data:{
                    assistido: assistido,
                    start: start,
                    end: end,
                    id: id,
                    type: 'update'
                },
                success:function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Agendamentos atualizados!");
                }
            })
        },
        eventDrop: function(agendas, delta)
        {
            var start = $.fullCalendar.formatDate(agendas.start, 'DD-MM-Y HH:mm');
            var end = $.fullCalendar.formatDate(agenda.end, 'DD-MM-Y HH:mm');
            var assistido = agenda.assistido;
            var id = agenda.id_assistido;
            $.ajax({
                url:"/calendario/action",
                type:"POST",
                data:{
                    assistido: assistido,
                    start: start,
                    end: end,
                    id: id,
                    type: 'update'
                },
                success:function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Agendamentos atualizados");
                }
            })
        },

        eventClick:function(event)
        {
            if(confirm("Remover agendamento?"))
            {
                var id = event.id;
                $.ajax({
                    url:"/calendario/action",
                    type:"POST",
                    data:{
                        id:id,
                        type:"delete"
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Agendamento cancelado com sucesso!");
                    }
                })
            }
        }
    
    
    });

});
  
</script>
  
</body>
</html>

@endsection  