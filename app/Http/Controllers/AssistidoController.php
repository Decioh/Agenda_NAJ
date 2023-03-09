<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Agenda;
use App\Models\Assistido;
use App\Models\AssistidoAgenda;
use App\Models\Historico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\facades\Auth;

class AssistidoController extends Controller
{
    public function index(){

        $agendas = Agenda::orderBy('start', 'asc')->orderBy('vag_h', 'desc')->simplePaginate(20); //passando todos as agendas para a view '/agendar', e ordenando.

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
            $assistido->user_id = Auth::user()->id;

            $assistido->save();
            $id=$assistido->id;

    return redirect()->route('agenda.list',['id'=>$id]);
    }

    public function edit($id){

        $assistido = Assistido::find($id);
        $agenda_id = Agenda::where('assistido_id',$id)->get('id');

    return view ('editassistido',['assistido'=>$assistido, 'agenda_id'=> $agenda_id]);
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
        $i=0;
        $assistido = Assistido::findOrFail($id);

        $user = User::findOrFail($assistido->user_id);

        $agendas_id = AssistidoAgenda::where('assistido_id',$id)->pluck('agenda_id');
        
        foreach($agendas_id as $agenda_id){
            $agendas[$i] = Agenda::where('id',$agenda_id)->first();
            $i++;
        }
        $assistido_agenda = AssistidoAgenda::all();
        $assistidos = Assistido::all('*');
        if(isset($agendas))
            return view('/info_assistido', ['user'=>$user, 'assistido' => $assistido, 'agendas'=> $agendas,'assistidos'=> $assistidos, 'assistido_agenda'=>$assistido_agenda]);
        else
            return view('/info_assistido', ['user'=>$user, 'assistido' => $assistido,'assistidos'=> $assistidos, 'assistido_agenda'=>$assistido_agenda]);
            
    }
    public function destroy($id){

        $agenda_id = Agenda::where('assistido_id',$id)->count();
        if($agenda_id != 0){ //Se existir ao menos uma agenda para o assistido:
            $ids = Agenda::where('assistido_id',$id)->where('historico_id','=', null)->pluck('id');
            $agenda_id = Agenda::where('assistido_id',$id)->pluck('id');
            $count = Historico::where('agenda_id',$agenda_id)->count();  
            if($count == 0){ //Se não existir agendamento em histórico, podemos deletar o agendamento
                    AssistidoAgenda::where('agenda_id',$ids)->delete();
                    $start = Agenda::where('id',$agenda_id)->pluck('start');
                    $vagas = Agenda::where('start',$start)->where('assistido_id',null)->pluck('start');
                    $vag_h = $vagas->count()+1;

                    DB::table('agendas')->where('id',$ids)
                        ->update(['assistido_id' => null,'info' => null, 'status' => 0,'vag_h' => $vag_h]);//Liberar a vaga sem deletar a agenda;

                    Assistido::destroy($id);
                return redirect('/')->with('msg', 'Assistido deletado!');
            }
            else {
            return redirect('/')->with('msg', 'Asssitido não pode ser deletado, pois consta atendimento em Histórico.');
            }
        }
        else{ // Se o assistido não foi cadastrado em nenhuma agenda:
            Assistido::destroy($id);
        return redirect('/')->with('msg', 'Assistido deletado!');
        }
    }
    public function store(Request $req){                                                                                                                                          
        
            $assistido = new Assistido();

            $assistido->nome = $req->nome;
            $assistido->nasc = $req->nasc;
            $assistido->cpf = $req->cpf;
            $assistido->telefone = $req->telefone;
            $assistido->email = $req->email;
            $assistido->user_id = Auth::user()->id;

            $assistido->save();
            $id = $req->agenda_id;

    return redirect()->route('agenda.join',['agenda_id'=>$id, 'id'=>$assistido->id]);
    
    }

}
