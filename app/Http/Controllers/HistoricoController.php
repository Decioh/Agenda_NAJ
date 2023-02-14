<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Assistido;
use Illuminate\Support\Facades\DB;
use App\Models\Historico;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HistoricoController extends Controller
{
    public function index(){

        $historicos = Historico::all('*');
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
            ->update(['historico_id' => $historico->id]);

        $assistido_agendas = DB::table('assistido_agendas')->where('agenda_id',$agenda_id)->get('*');
        $agendas_assistidos = DB::table('assistido_agendas')->where('agenda_id',$agenda_id)->get('*');

    return view ('historico_add_parecer',['historico'=>$historico,'agenda'=>$agenda,'assistido_agendas'=>$assistido_agendas,'agendas_assistidos'=>$agendas_assistidos]);
    }
    public function info($historico, Request $req){

        $info = $req->info;
        $parecer = $req->parecer;
        $faltante = $req->parte_faltante;
        if($parecer=='Parte não compareceu'){
            $parecer = $parecer." parte faltante: ".$faltante;
        }

        DB::table('historicos')->where('id', $historico)
            ->update(['parecer' => $parecer,'info' => $info]);

        return redirect()->route('historico.index');
    }
}
