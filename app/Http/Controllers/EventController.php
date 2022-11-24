<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{

    public function index(){

        /*$search = request('search');

        if($search){
            
            $events = Event::where([
                ['assistido','like','%'.$search.'%']
            ])->get();
        }
        else{
            $events = Event::all();
        }
*/
    return view('welcome'/*,['events' => $events, 'search' => $search]*/);
    }
    public function create(){
        return view('/mediacao/criar_agenda');
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
        $vag_h = $request -> vag_h;

        $end = 0;                   //Inicializando a variável pro laravel não reclamar;
        $aux = $start;              //Variável auxiliar, para resetar o $start depois de cada loop;
        $start = strtotime($start); //Retorna uma timestamp que pode ser trabalhada em contas;
        $fim   = strtotime($fim);   //Retorna uma timestamp que pode ser trabalhada em contas;
        $dow = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado');
        $diff = $fim - $start;      //Vamos usar para delimitar os dias onde serão criadas as agendas;
        $diff = (($diff/60)/60)/24; //Convertendo de segundos para dias;
        $k = $vag_h;                //Variável k, para criar k agendamentos para o mesmo horario;
        for($k>0;$k>0;$k--){
            
            for($j=0; $j <= $diff;$j++){                                            //for para ir para o próximo dia
                $start = date('Y-m-d H:i', strtotime("+$j days",strtotime($aux)));  // aumentar $j dias, 0 dias, 1 dia, 2 dias...;
                $start = strtotime($start);                                         // Transforma $start em tempo Unix que pode ser manipulado;
                $day = date('w',$start);                                            // iguala $day ao dia da semana atual;
                $dia = $dow[$day];
                $start = date('Y-m-d H:i', strtotime("+$j days",strtotime($aux)));  // retorna a variável $start para a date correta com ajuda da variavel auxiliar;
                if($day==$dom || $day==$seg || $day==$ter || $day==$qua || $day==$qui || $day==$sex || $day==$sab){ //compara com todos os dias, só vai ser igual nos dias selecionados pelo usuário
                for ($i=0 ; $i<$vagas ; $i++){ //ir para o próximo agendamento;
                    if($i==0){  // o primeiro loop ajusta o horario para o começo dos agendamentos;
                        $end = date('Y-m-d H:i', strtotime("+$dur minutes",strtotime($start))); // o $end vai ser a data inicial + a duração de cada atendimento;
                        /*Salvando dados no banco de dados */
                        $event = new Event;
                        $event->assistido = 'Horário vago'; // Nome padrão é Horário vago, depois será o nome do Assistido;
                        $event->start = $start; 
                        $event->vag_h = $vag_h;
                        $event->end   = $end;
                        $event->dia   = $dia;

                        }
                    else{ // Os outros loops só precisam igualar o start ao end do último evento, e assim começar onde o último agendamento terminou;
                        $start = $end;   
                        $end = date('Y-m-d H:i', strtotime("+$dur minutes",strtotime($start)));
                        /*Salvando dados no banco*/
                        $event = new Event;            
                        $event->assistido = 'Horário vago';
                        $event->start = $start;
                        $event->vag_h = $vag_h;
                        $event->end   = $end;
                        $event->dia   = $dia;
                        }
                    $event->dur = $dur;
                    $user = auth()->user();
                    $event->user_id = $user->id;
                    $event->save();                
                }
            

        }   } $vag_h = $vag_h-1;  }
        
        return redirect('calendario')->with('msg','Agendamento criado com sucesso!');
        }

       public function listar($id) {

            $event = Event::findOrFail($id);

            $eventOwner = User::where('id', $event->user_id)->first()->toArray();

            return view('/cadastroassistido', ['event' => $event, 'eventOwner'=> $eventOwner]);
        }
        public function show($id) {

            $event = Event::findOrFail($id);

            $eventOwner = User::where('id', $event->user_id)->first()->toArray();

            return view('/cadastroassistido', ['event' => $event, 'eventOwner'=> $eventOwner]);
        }

        public function schedule(){

            $events = Event::orderBy('start','asc')->get(); //passando todos os eventos pra view '/novo/agendar'

        return view('mediacao/agendamentos',['events' => $events]);   
        }

        public function update(Request $req){

            
            $event=Event::find(($req->id));
            $event -> vag_h = 0;
            $event -> assistido=$req->assistido;
            $event -> nasc=$req->nasc;
            $event -> cpf=$req->cpf;
            $event -> cep=$req->cep;
            $event -> info=$req->info;

            $event-> save();
        return redirect('/')->with('msg', 'Agendamento concluído!');
        }

        public function dashboard(){

            $user = auth()->user();

            $events = $user->events;

            $events = DB::table('events')->orderBy('start', 'asc')->get();

            return view('novo.dashboard', ['events' => $events]);
        }
}