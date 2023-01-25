<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Historico;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HistoricoController extends Controller
{
    public function index(){

        $historicos = Historico::all('*');

    return view ('historico',['historicos'=>$historicos]);
    }
    public function create($agenda_id){

        $agenda =  DB::table('agendas')->where('id',$agenda_id)->first('*');  //Pega as infos da agenda para passar na view
                                                      
            $historico = new Historico();
            $historico->start = $agenda->start;
            $historico->dur = $agenda->dur;
            $historico->parecer = null;
            $historico->agenda_id = $agenda->id;
            $historico->user_id = $agenda->user_id;

        $historico->save();  

        $assistido_agendas = DB::table('assistido_agendas')->where('agenda_id',$agenda_id)->get('*');

    return view ('historico_add_parecer',['historico'=>$historico,'agenda'=>$agenda,'assistido_agendas'=>$assistido_agendas]);
    }
    public function info($historico, Request $req){

        $info = $req->info;
        $parecer = $req->parecer;

        DB::table('historicos')->where('id', $historico->id)
            ->update(['parecer' => $parecer,'info' => $info]);

        $historicos = Historico::all('*');

    return view ('historico',['historicos'=>$historicos]);
    }
}
