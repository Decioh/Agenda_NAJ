<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function index(){

        $events = Event::all(); //passando todos os eventos pra view '/'

        return view('welcome',['events' => $events]);
    }
    public function create(){
        return view('novo/novo-agendamento');
    }

    public function store(Request $request){

        $dur   = $request -> dur;
        $vagas = $request -> vagas;
        $start = $request -> start;
        $fim   = $request -> fim;
        $seg   = $request -> seg;
        $ter   = $request -> ter;
        $qua   = $request -> qua;
        $qui   = $request -> qui;
        $sex   = $request -> sex;
        $sab   = $request -> sab;
        $dom   = $request -> dom;
        
        $end = 0;                   //Inicializando a variável pro laravel não reclamar;
        $aux = $start;              //Variável auxiliar, para resetar o $start depois de cada loop;
        $start = strtotime($start); //Retorna uma timestamp que pode ser trabalhada em contas;
        $fim   = strtotime($fim);   //Retorna uma timestamp que pode ser trabalhada em contas;
        $dow = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado');
        $diff = $fim - $start;      //Vamos usar para delimitar os dias onde serão criadas as agendas;
        $diff = (($diff/60)/60)/24; //Convertendo de segundos para dias;

        for($j=0; $j <= $diff;$j++){ //for para ir para o próximo dia
            $start = date('Y-m-d H:i', strtotime("+$j days",strtotime($aux)));  // aumentar $j dias, 0 dias, 1 dia, 2 dias...;
            $start = strtotime($start);                                         // Transforma $start em tempo Unix que pode ser manipulado;
            $day = date('w',$start);                                            // iguala $day ao dia da semana atual;
            $dia = $dow[$day];
            $start = date('Y-m-d H:i', strtotime("+$j days",strtotime($aux)));  // retorna a variável $start para a date correta com ajuda da variavel auxiliar;
            if($day==$dom || $day==$seg || $day==$ter || $day==$qua || $day==$qui || $day==$sex || $day==$sab){ //compara com todos os dias, só vai ser igual nos dias selecionados pelo usuário
            for ($i=0 ; $i<$vagas ; $i++){ //ir para o próximo agendamento;
                if($i==0){  // o primeiro loop ajuda o horario para o começo dos agendamentos;
                    $end = date('Y-m-d H:i', strtotime("+$dur minutes",strtotime($start))); // o $end vai ser a data inicial + a duração de cada atendimento;

                    /*Salvando dados no banco de dados */
                    $event = new Event;
                    $event->title = 'Horário vago'; // Nome padrão é Horário vago, depois será o nome do Assistido;
                    $event->start = $start; 
                    $event->vag_h = $request-> vag_h;
                    $event->end   = $end;
                    $event->dia   = $dia;
                    $event->save();
                    }
                else{ // Os outros loops só precisam igualar o start ao end do último evendo, e assim começar onde o último agendamento terminou;
                    $start = $end;   
                    $end = date('Y-m-d H:i', strtotime("+$dur minutes",strtotime($start)));
                    /*Salvando dados no banco*/
                    $event = new Event;            
                    $event->title = 'Horário vago';
                    $event->start = $start;
                    $event->vag_h = $request-> vag_h;
                    $event->end   = $end;
                    $event->dia   = $dia;
                    $event->save();
                    }
                
            }
        }}
        
        return redirect('/calendario')->with('msg','Agendamento criado com sucesso!');
        }
    
      /*  public function show($id) {
            $event = Event::findOrFail($id);

            return view('events.show', ['event' => $event]);
        }*/
}