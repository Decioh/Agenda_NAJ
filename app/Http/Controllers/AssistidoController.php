<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Agenda;
use App\Models\Agendamento;
use App\Models\Assistido;
use Illuminate\Http\Request;
use Jenssegers\Agent\Facades\Agent;

class AssistidoController extends Controller
{
    public function index(){

        $agendas = Agenda::orderBy('start','asc')->get(); //passando todos os eventos pra view '/agendar', e ordenando.

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
        $vag_h = $req-> vag_h;
        if( $vag_h == 1 ){                                                                                           
            
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

        } else {
            $newAgenda = $agenda->replicate();                                              
            $newAgenda->vag_h -= 1; 
            $newAgenda->save();
        
            $agendamento = new Agendamento();
            $agendamento->id_agenda = $newAgenda->id;
            $user = auth()->user();
            $agendamento->user_id = $user->id;
            $agendamento->save();

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
        }

        public function destroy($id){

   
            
        $agendamento = Agendamento::where('id_assistido', $id)->with(['id_assistido','Status'])->first();

        $agendamento->id_assistido = null;

        $agendamento    ->Status = 0;

        $agendamento->save();

                 
        $agenda = Agenda::find('assistido_id', $id)->with(['assistido_id'])->first();

        $agenda ->  assistido_id = null;

        $agenda->save();


        return redirect('/')->with('msg', 'Agendamento cancelado!');
        }
        
    
    }
