<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Assistido;
use App\Models\AssistidoAgenda;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Models\Historico;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Http\traits\HistoricTrait;

class HistoricoController extends Controller
{
    public function index(){
        $search = request('search');
            if($search){
                $i=0;
                $agenda_ids = AssistidoAgenda::where('nome_assistido', 'like', '%'.$search.'%')->pluck('agenda_id');
                if(count($agenda_ids)>0){
                    foreach($agenda_ids as $agenda_id){
                        $historicos[$i] = DB::table('historicos')->where('agenda_id', '=', $agenda_id)->first();
                        $i++;
                    }
                $historicos = array_filter( $historicos);
                }
                else if(count($agenda_ids)==0){
                    $historicos = 0;
                    $agendas = Agenda::all('*');
                    $assistidos = Assistido::all('*');

                return view ('historico',['historicos'=>$historicos,'assistidos'=>$assistidos,'agendas'=>$agendas,'search'=>$search])->with('msg', 'Não foi encontrado um Histórico com esse nome');
                }   
            }
            else{
                $historicos = Historico::all('*')->sortBy('start');
            }     
        $agendas = Agenda::all('*');
        $assistidos = Assistido::all('*');

    return view ('historico',['historicos'=>$historicos,'assistidos'=>$assistidos,'agendas'=>$agendas]);
    }
    public function create($agenda_id){

        $agenda =  DB::table('agendas')->where('id',$agenda_id)->first('*');  //Pega as infos da agenda para passar na view
                                                      
            $historico = new Historico();
            $historico->start = $agenda->start;
            $historico->parecer = null;
            $historico->agenda_id = $agenda->id;
            $historico->user_id = $agenda->user_id;

        $historico->save();
        
        DB::table('agendas')->where('id',$agenda_id)
            ->update(['status' => 3]);

        DB::table('agendas')->where('id',$agenda_id)
            ->update(['historico_id' => $historico->id]);

        $assistido_agendas = DB::table('assistido_agendas')->where('agenda_id',$agenda_id)->get('*');
        $agendas_assistidos = DB::table('assistido_agendas')->where('agenda_id',$agenda_id)->get('*');

    return view ('historico_add_parecer',['historico'=>$historico,'agenda'=>$agenda,'assistido_agendas'=>$assistido_agendas,'agendas_assistidos'=>$agendas_assistidos]);
    }
    public function store($historico, Request $req){

        $info = $req->info;
        $parecer = $req->parecer;
        $faltante = $req->parte_faltante;
        if($parecer=='Parte não compareceu'){
            $parecer = $parecer.':'.$faltante;
        }

        DB::table('historicos')->where('id', $historico)
            ->update(['parecer' => $parecer,'info' => $info]);

        return redirect()->route('historico.index');
    }
    public function info($agenda_id){
        $i=0;
        $historico = Historico::where('agenda_id',$agenda_id)->get();
        $agendas = Agenda::where('id',$agenda_id)->get();
        $assistido_ids = AssistidoAgenda::where('agenda_id',$agenda_id)->pluck('assistido_id');
        foreach($assistido_ids as $assistido_id){
            $assistidos[$i] = Assistido::where('id',$assistido_id)->first();
            $i++;
        }
    return view ('historico_info',['historico'=>$historico,'assistidos'=>$assistidos,'agendas'=>$agendas]);
    }
    function wrap_implode( $array, $before = '', $after = '', $separator = '' ){
        if( ! $array )  return '';
        return $before . implode("{$after}{$separator}{$before}", $array ) . $after;
      }

    public function dashboard(){
        $ano = Carbon::now()->format('Y');
        $assistidos = Assistido::all()->count();  
        $historicos = Historico::all()->count(); 
        $agendamentos = Agenda::where('assistido_id','!=', null)->count();
        $ano = request('ano');    
        $mes_filter = request('mes_filter');
        $selected_month = 'todos os meses';

        /*Gráfico 1*/
        $atendimentos_mes = Historico::select([
            DB::raw('YEAR(start) as year'),
            DB::raw('MONTH(start) as mes'),
            DB::raw('COUNT(*) as total')
        ])
        ->groupBy('year')
        ->orderBy('year', 'asc')
        ->groupBy('mes')
        ->orderBy('mes','asc')
        ->get();
        setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
        $month = array('Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'jul', 'Agosto', 'Set', 'Out', 'Nov', 'Dez');
        if($ano){ 
            foreach($atendimentos_mes as $atendimento){
                if ($atendimento->year == $ano){
                    $year[] = $atendimento->year;
                    $mes[] = "'".($month[($atendimento->mes-1)])."'";
                    $tot_mes[] = $atendimento->total;
                }
            }
            if(isset($mes)){
                $meses = implode(',', $mes);
                $tot_p_mes = implode(',', $tot_mes);
            }
            else{
                $meses = 'nenhum agendamento no Ano selecionado';
                $tot_p_mes = 0;
            }
        }
        else{
            foreach($atendimentos_mes as $atendimento){
                $year[] = "'".($atendimento->year."'");
                $mes[] = "'".($month[($atendimento->mes-1)])." - ".($atendimento->year)."'";
                $tot_mes[] = $atendimento->total;
            }
            if(isset($mes)){
                $meses = implode(',', $mes);
                $tot_p_mes = implode(',', $tot_mes);
            }
        }
        /*Gráfico 2*/
        if($ano){   /*Se tiver filtragem por ano*/
            if($mes_filter){ /* Se tiver filtragem por ano e por mês*/
            $selected_month = $month[(($mes_filter)-1)];
            $acordo_realizado = Historico::whereYear('start',$ano)->whereMonth('start', $mes_filter)->where('parecer', '=', 'Acordo realizado')->count();
            $acordo_inviavel = Historico::whereYear('start',$ano)->whereMonth('start', $mes_filter)->where('parecer', '=', 'Acordo inviável')->count();
            $nao_compareceu = Historico::whereYear('start',$ano)->whereMonth('start', $mes_filter)->where('parecer', 'like', '%'.'Parte não compareceu'.'%')->count();
            $processo_judicializado = Historico::whereYear('start',$ano)->whereMonth('start', $mes_filter)->where('parecer', '=', 'Processo judicializado')->count();

            }
            else{/*Filtragem apenas por ano*/
            $acordo_realizado = Historico::whereYear('start',$ano)->where('parecer', '=', 'Acordo realizado')->count();
            $acordo_inviavel = Historico::whereYear('start',$ano)->where('parecer', '=', 'Acordo inviável')->count();
            $nao_compareceu = Historico::whereYear('start',$ano)->where('parecer', 'like', '%'.'Parte não compareceu'.'%')->count();
            $processo_judicializado = Historico::whereYear('start',$ano)->where('parecer', '=', 'Processo judicializado')->count();
            }
        }
        else{/*Sem filtragem */
            $acordo_realizado = Historico::where('parecer', '=', 'Acordo realizado')->count();
            $acordo_inviavel = Historico::where('parecer', '=', 'Acordo inviável')->count();
            $nao_compareceu = Historico::where('parecer', 'like', '%'.'Parte não compareceu'.'%')->count();
            $processo_judicializado = Historico::where('parecer', '=', 'Processo judicializado')->count();
        }

        $total = $acordo_inviavel+$acordo_realizado+$nao_compareceu+$processo_judicializado;

        if($total == 0) $total=1;//Caso total igual a zero, evitamos uma divisão por zero;

        /* Dados em porcentagem*/
        $acordo_inviavel_p        = number_format(((float)$acordo_inviavel/$total)*100, 2, '.', '');
        $nao_compareceu_p         = number_format(((float)$nao_compareceu/$total)*100, 2, '.', '');
        $acordo_realizado_p       = number_format(((float)$acordo_realizado/$total)*100, 2, '.', '');
        $processo_judicializado_p = number_format(((float)$processo_judicializado/$total)*100, 2, '.', '');
        $acordo_inviavel_p        = $acordo_inviavel_p        ."%";
        $nao_compareceu_p         = $nao_compareceu_p         ."%";
        $acordo_realizado_p       = $acordo_realizado_p       ."%";
        $processo_judicializado_p = $processo_judicializado_p ."%";

    return view('estatisticas',['month'=>$month, 'selected_month'=>$selected_month,'ano'=>$ano,'meses'=>$meses, 'tot_p_mes'=>$tot_p_mes ,'total'=>$total,'assistidos'=>$assistidos,
    'historicos'=>$historicos,'agendamentos'=>$agendamentos,'acordo_realizado'=>$acordo_realizado,'acordo_inviavel'=>$acordo_inviavel,
    'nao_compareceu'=>$nao_compareceu,'processo_judicializado'=>$processo_judicializado, 'acordo_realizado_p'=>$acordo_realizado_p,
    'acordo_inviavel_p'=>$acordo_inviavel_p,'nao_compareceu_p'=>$nao_compareceu_p,'processo_judicializado_p'=>$processo_judicializado_p]);
    }

}
