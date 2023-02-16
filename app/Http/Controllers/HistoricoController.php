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

class HistoricoController extends Controller
{
    public function index(){
        $search = request('search');
            if($search){
                $i=0;
                $agenda_ids = AssistidoAgenda::where('nome_assistido', 'like', '%'.$search.'%')->pluck('agenda_id');
                if(count($agenda_ids)>0){
                    foreach($agenda_ids as $agenda_id){
                        $historicos[$i] = DB::table('historicos')->where('agenda_id', 'like', $agenda_id)->first();
                        $i++;
                    }
                $historicos = array_filter( $historicos);
                }
                else{
                    $historicos = Historico::all('*');
                    $agendas = Agenda::all('*');
                    $assistidos = Assistido::all('*');

                return view ('historico',['historicos'=>$historicos,'assistidos'=>$assistidos,'agendas'=>$agendas])->with('msg', 'Não foi encontrado um Histórico nesse nome');
                }   
            }
            else{
                $historicos = Historico::all('*');
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
}
