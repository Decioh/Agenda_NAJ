<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Agenda;
use App\Models\Agendamento;
use App\Models\Assistido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\facades\Auth;
use Jenssegers\Agent\Facades\Agent;

class AssistidoController extends Controller
{
    public function index(){

        $assistidos = DB::table('assistidos');
        $agendas = Agenda::orderBy('start', 'asc')->orderBy('vag_h', 'desc')->paginate(20); //passando todos os eventos pra view '/agendar', e ordenando.
        $agendamentos = DB::table('agendamentos');

    return view('agendar', ['agendas' => $agendas,'assistidos'=>$assistidos,'agendamentos'=>$agendamentos]);
    }

    public function list(){
        
        $search = request('search');
        if($search){
            $assistidos = DB::table('assistidos')
                ->where('nome', 'like', '%'.$search.'%')
                ->orWhere('cpf', 'like','%'.$search.'%')->paginate(20);
        }
        else{
            $assistidos = Assistido::orderBy('nome', 'asc')->paginate(20);
        }

    return view ('assistido', ['assistidos'=>$assistidos, 'search'=>$search]);
    }

    public function create($id) {

        $agenda = Agenda::findOrFail($id);

    return view('/cadastroassistido', ['agenda' => $agenda]);
    }
    public function novo() {

        return view('/cadastroassistido_semagendamento');
    }
    public function criar(Request $req){
        
            $nome = $req->nome;
            $nasc = $req->nasc;
            $cpf = $req->cpf;
            $email = $req->email;
            $telefone = $req->telefone;

            $assistido = new Assistido();

            $assistido->nome = $nome;
            $assistido->nasc = $nasc;
            $assistido->cpf = $cpf;
            $assistido->email = $email;
            $assistido->telefone = $telefone;

            $assistido->save();

    return redirect ('/assistido');
    }

    public function edit($id){

        $assistido = Assistido::find($id);
        $agenda = DB::table('agendas')->where('assistido_id',$id)->get();

    return view ('editassistido',['assistido'=>$assistido, 'agenda'=> $agenda]);
    }

    public function update(Request $req){

        $assistido = Assistido::find($req -> id);

        $assistido  -> nome=$req->nome;
        $assistido  -> nasc=$req->nasc;
        $assistido  -> cpf = $req->cpf;
        $assistido  -> email = $req->email;
        $assistido  -> telefone = $req->telefone;

        $assistido->save();
        $agendas = Agenda::orderBy('start','asc')->orderBy('vag_h','desc')->paginate(21); //passando todos os eventos pra view '/meadiacao/agendamentos'
        $agendamentos = DB::table('agendamentos')->get();
    
        return view('/mediacao/agendamentos',['agendas' => $agendas,'agendamentos' => $agendamentos])->with('msg', 'Dados Atualizados!');
    }
    public function show($id) {

        $assistido = Assistido::findOrFail($id);

        $agenda = DB::table('agendas')->where('assistido_id',$id)->get();

    return view('/info_assistido', ['assistido' => $assistido, 'agenda'=> $agenda]);
    }
    public function destroy($id){

        DB::table('agendamentos')->where([['assistido_id', $id]])
        ->update(['Status' => 0, 'assistido_id'=> null]);

        DB::table('agendas')->where('assistido_id', $id)
        ->update(['assistido_id' => null]);
        Assistido::destroy('id', $id);

    return redirect('/')->with('msg', 'Assistido deletado!');
    }
    public function store(Request $req){                                                                                                                                          
            
            $nome      = $req->nome;
            $nasc      = $req->nasc;
            $cpf       = $req->cpf;
            $email     = $req->email;
            $telefone  = $req->telefone;
            $agenda_id = $req->id;
            $info      = $req->info;

            $assistido = new Assistido();

            $assistido->nome = $nome;
            $assistido->nasc = $nasc;
            $assistido->cpf = $cpf;
            $assistido->email = $email;
            $assistido->telefone = $telefone;

            $assistido->save();

            $agenda = Agenda::find($req->id);

            $agenda->assistido_id = $assistido->id;
            $agenda->info = $info;

            $agenda->save();

            $agendamento = Agendamento::find($agenda_id);

            $agendamento->assistido_id = $agenda->assistido_id;
            $agendamento->Status = '1';

            $agendamento->save();

        if ((Auth::user()->user_type) == 2){
            return redirect('assistido')->with('msg', 'Assistido Cadastrado!');
        }
        
        elseif((Auth::user()->user_type) == 1)
            return redirect('/mediacao/agendamentos')->with('msg', 'Assistido Cadastrado!');
        
        }
    
    }
