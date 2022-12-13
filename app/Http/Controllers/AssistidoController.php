<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Agenda;
use App\Models\Agendamento;
use App\Models\Assistido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Facades\Agent;

class AssistidoController extends Controller
{
    public function index(){
        
        $agendas = Agenda::orderBy('start','asc')->orderBy('vag_h','desc')->get();//passando todos os eventos pra view '/agendar', e ordenando.

    return view('agendar', ['agendas' => $agendas]);
    }
    public function create($id) {

        $agenda = Agenda::findOrFail($id);

    return view('/cadastroassistido', ['agenda' => $agenda]);
    }

    public function edit($id){

        $assistido = Assistido::find($id);

        return view ('editassistido',['assistido'=>$assistido]);
    }
    public function update(Request $req){

        $assistido = Assistido::find($req -> id);

        $assistido  -> nome=$req->nome;
        $assistido  -> nasc=$req->nasc;
        $assistido  -> cpf = $req->cpf;
        $assistido  -> email = $req->email;
        $assistido  -> telefone = $req->telefone;
        $assistido  -> info = $req->info;

            $assistido->save();

        return redirect('/mediacao/agendamentos')->with('msg', 'Dados Atualizados!');
    }
    public function store(Request $req){
        
        $agenda=Agenda::find(($req->id));                                                                                                                                            
            
            $nome = $req->nome;
            $nasc = $req->nasc;
            $cpf = $req->cpf;
            $email = $req->email;
            $telefone = $req->telefone;
            $info = $req->info;
            $agenda_id = $req->id;

            $assistido = new Assistido();

            $assistido->nome = $nome;
            $assistido->nasc = $nasc;
            $assistido->cpf = $cpf;
            $assistido->email = $email;
            $assistido->telefone = $telefone;
            $assistido->info = $info;

            $assistido->save();

            $agenda = Agenda::find($req->id);

            $agenda->assistido_id = $assistido->id;

            $agenda->save();

            $agendamento = Agendamento::find($agenda_id);

            $agendamento->id_assistido = $agenda->assistido_id;
            $agendamento->Status = '1';

            $agendamento->save();
        
            return redirect('/mediacao/agendamentos')->with('msg', 'Agendamento concluído!');
        
        }
        public function show($id) {

            $assistido = Assistido::findOrFail($id);

            $agenda = Agenda::where('id', $assistido->assistido_id)->first()->toArray();

            return view('/info_assistido', ['assistido' => $assistido, 'agenda'=> $agenda]);
        }
        public function destroy($id){

        DB::table('agendamentos')->where('id_assistido', $id)
        ->update(['Status' => 0, 'id_assistido'=> null]);

        DB::table('agendas')->where('assistido_id', $id)
            ->update(['assistido_id' => null]);

        return redirect('/')->with('msg', 'Agendamento cancelado!');
        }
        
    
    }
