<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Agenda;
use App\Models\Assistido;
use App\Models\AssistidoAgenda;
use App\Models\Historico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssistidoController extends Controller
{
    public function index(){

        $agendas = Agenda::orderBy('start', 'asc')->orderBy('vag_h', 'desc')->simplePaginate(51); //passando todos as agendas para a view '/agendar', e ordenando.

    return view('/mediacao/agendamentos', ['agendas' => $agendas]);
    }

    public function list(){
        
        $search = request('search');
            if($search){
                $assistidos = DB::table('assistidos')
                    ->where('nome', 'like', '%'.$search.'%')
                    ->orWhere('cpf', 'like','%'.$search.'%')->simplePaginate(20);
            }
            else{
                $assistidos = Assistido::orderBy('nome', 'asc')->simplePaginate(20);
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
            $id=$assistido->id;

    return redirect()->route('agenda.list',['id'=>$id]);
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
        $assistidos = Assistido::orderBy('nome', 'asc')->simplePaginate(20);

        return view('/assistido',['assistidos' => $assistidos])->with('msg', 'Dados Atualizados!');
        
    }
    public function info($id) {

        $assistido = Assistido::findOrFail($id);

        $agenda_id = AssistidoAgenda::where('assistido_id',$id)->get('agenda_id');

        $agenda = Agenda::where('assistido_id',$id)->get();


        $assistido_agenda = AssistidoAgenda::all();
        


        $assistidos = Assistido::all('*');
        
    return view('/info_assistido', ['assistido' => $assistido, 'agenda'=> $agenda,'assistidos'=> $assistidos, 'assistido_agenda'=>$assistido_agenda]);
    }
    public function destroy($id){

        DB::table('agendas')->where('assistido_id', $id)
        ->update(['assistido_id' => null,'Status' => 0]);
        Assistido::destroy('id', $id);

    return redirect('/')->with('msg', 'Assistido deletado!');
    }
    public function store(Request $req){                                                                                                                                          
        
            $assistido = new Assistido();

            $assistido->nome = $req->nome;
            $assistido->nasc = $req->nasc;
            $assistido->cpf = $req->cpf;
            $assistido->telefone = $req->telefone;
            $assistido->email = $req->email;

            $assistido->save();
            $id = $req->agenda_id;

    return redirect()->route('agenda.join',['agenda_id'=>$id, 'id'=>$assistido->id]);
    
    }

}
