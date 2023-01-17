<?php

namespace App\Http\Controllers;
use App\Models\Agenda;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\facades\Auth;
use Carbon\Carbon;
class AgendaController extends Controller
{
    public function create(){
        return view('/mediacao/criar_agenda');
    }
    public function index(){

        $agendas = Agenda::orderBy('start','asc')->orderBy('vag_h','desc')->simplePaginate(51); //passando todos os eventos pra view '/meadiacao/agendamentos'

    return view('/mediacao/agendamentos',['agendas' => $agendas]);   
    }
    public function edit($id){
        $agenda = Agenda::where('id',$id)->first();
        if($agenda->Status==1){
            DB::table('agendas')->where([['id', $id]])->update(['Status' => 2]);
        }
        elseif($agenda->Status==2){
            DB::table('agendas')->where([['id', $id]])->update(['Status' => 1]);
        }        
        
    return back();
    }
    public function destroy($id){

        DB::table('agendas')->where('assistido_id', $id)->orderBy('updated_at','asc')->take(1)
            ->update(['assistido_id' => null,'info' => null, 'status' => 0]);

    
        return redirect('/')->with('msg', 'Agendamento cancelado!');
    }

    public function store(Request $request)
    {
        $dur = $request->dur;
        $vagas = $request->vagas;
        $start = $request->start;
        $end   = $request->end;
        $fim = $request->fim;
        $seg = $request->seg;
        $ter = $request->ter;
        $qua = $request->qua;
        $qui = $request->qui;
        $sex = $request->sex;
        $sab = $request->sab;
        $dom = $request->dom;
        $vag_h = $request->vag_h;

        $aux = $start; //Variável auxiliar, para resetar o $start depois de cada loop;
        $start = strtotime($start); //Retorna uma timestamp que pode ser trabalhada em contas;
        $fim = strtotime($fim); //Retorna uma timestamp que pode ser trabalhada em contas;
        $dow = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado');
        $diff = $fim - $start; //Vamos usar para delimitar os dias onde serão criadas as agendas;
        $diff = (($diff / 60) / 60) / 24; //Convertendo de segundos para dias;
        //$k = $vag_h; //Variável k, para criar k agendamentos para o mesmo horario;
        //for ($k > 0; $k > 0; $k--) {

            for ($j = 0; $j <= $diff; $j++) { //for para ir para o próximo dia
                $start = date('Y-m-d H:i', strtotime("+$j days", strtotime($aux))); // aumentar $j dias, 0 dias, 1 dia, 2 dias...;
                $start = strtotime($start); // Transforma $start em tempo Unix que pode ser manipulado;
                $day = date('w', $start); // iguala $day ao dia da semana atual;
                $dia = $dow[$day];
                $start = date('Y-m-d H:i', strtotime("+$j days", strtotime($aux))); // retorna a variável $start para a date correta com ajuda da variavel auxiliar;
                if ($day == $dom || $day == $seg || $day == $ter || $day == $qua || $day == $qui || $day == $sex || $day == $sab) { //compara com todos os dias, só vai ser igual nos dias selecionados pelo usuário
                    for ($i = 0; $i < $vagas; $i++) { //ir para o próximo agendamento;
                        if ($i == 0) { // o primeiro loop ajusta o horario para o começo dos agendamentos;
                            $end = date('Y-m-d H:i', strtotime("+$dur minutes", strtotime($start))); // o $end vai ser a data inicial + a duração de cada atendimento;
                            /*Salvando dados no banco de dados */
                            $agenda = new Agenda();
                            $agenda->start = $start;
                            $agenda->vag_h = $vag_h;
                            $agenda->end = $end;
                            $agenda->dia = $dia;
                            $agenda->user_id= Auth::user()->id;

                        } else { // Os outros loops só precisam igualar o start ao end do último evento, e assim começar onde o último agendamento terminou;
                            $start = $end;
                            $end = date('Y-m-d H:i', strtotime("+$dur minutes", strtotime($start)));
                            /*Salvando dados no banco*/
                            $agenda = new Agenda();
                            $agenda->start = $start;
                            $agenda->end = $end;
                            $agenda->dia = $dia;
                            $agenda->vag_h = $vag_h;
                            $agenda->user_id= Auth::user()->id;
                        }
                        $agenda->dur = $dur;

                        $agenda->save();
                    }


                }
            }
            //$vag_h = $vag_h - 1;
            //}
        return redirect('mediacao/agendamentos')->with('msg', 'Agendamento criado com sucesso!');
    }

    public function list($id){
        $id;
        $agendas = Agenda::orderBy('start','asc')->orderBy('vag_h','desc')->paginate(21); //passando todos os eventos pra view 'agendar_assistido'
    
    return view ('agendar_assistido', ['agendas' => $agendas,'assistido_id'=>$id]);
    }

    public function info(Request $req, $agenda_id){
        $info = $req->info;
        DB::table('agendas')->where('id',$agenda_id)->update(['info' => $info]);

        if ((Auth::user()->user_type) == 2){
            return redirect('/')->with('msg', 'Agenda marcada com sucesso!');
        }
        
        elseif((Auth::user()->user_type) == 1){
            return redirect('/mediacao/agendamentos')->with('msg', 'Agenda marcada com sucesso!');
        
        }
    }
    public function criar($assistido_id, $agenda_id){

        $agenda = Agenda::find($agenda_id);
        if($agenda->vag_h>1){
            $new_agenda = $agenda->replicate();
            $new_agenda->vag_h = $agenda->vag_h-1;
            $new_agenda->save();
        }

        $agenda->assistido_id = $assistido_id;
        $agenda->Status = '1';

        $agenda->save();

        return view('info_form',['agenda_id'=> $agenda_id])->with('msg', 'Agenda marcada com sucesso!');
    
    }
}


