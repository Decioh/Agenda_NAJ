@extends('layouts.main')

@section('title', 'Agendamentos')

@section('content')
    <p>Ferramenta para conciliação de horarios de agendamentos <br>
    entre a escola e o NAJ.
    </p>
    <form nome="dias_disponíveis" method="post" action="horarios.php">
        <label for="data">Selecione um dia e seus <br>
            horarios de atendimento: <br><br></label>
            <input type="date" name="dia" id="data">
        <br>                    
        <label
         for="h_ini"><br>Escolha o horario em que deseja começar a atender: 
        </label>
        <input type="time" id="h_ini" name="h_ini">
        <br>
        <label
         for="h_fim"><br>Escolha o horario em que deseja o último agendamento: 
        </label>
        <input type="time" id="h_fim" name="h_fim">
        <p><input value="enviar" type="submit"/>  
        </p>
    </form>     
@endsection  