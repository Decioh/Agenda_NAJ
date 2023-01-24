<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Agenda;
use App\Models\Assistido;
use App\Models\AssistidoAgenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\facades\Auth;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use Jenssegers\Agent\Facades\Agent;
class AssistidoController extends Controller
{
    public function index(){

        $agendas = Agenda::orderBy('start', 'asc')->orderBy('vag_h', 'desc')->simplePaginate(51); //passando todos as agendas para a view '/agendar', e ordenando.

    return view('agendar', ['agendas' => $agendas]);
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

            /*$assistido_agenda = new AssistidoAgenda();
            $assistido_agenda->agenda_id = null;
            $assistido_agenda->assistido_id = $assistido->id;
            $assistido_agenda->nome_assistido = $assistido->nome;
        
        $assistido_agenda->save();  */
                $agenda =  DB::table('agendas')->where('start','<', Carbon::yesterday())->pluck('id');  //Pega os ids das datas já antigas
                foreach($agenda as $agenda){                                              //Anda entre os ids que salvamos
                Agenda::destroy($agenda);                                                 //Apaga os dados de agenda
                }                         
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
    public function show($id) {

        $assistido = Assistido::findOrFail($id);

        $agenda = DB::table('agendas')->where('assistido_id',$id)->get();
        
        //$agenda_id = Agenda::where('assistido_id','=',$id)->first('id');

        $assistido_agenda = AssistidoAgenda::all();
        


        $assistidos = Assistido::all('*');
        
    return view('/info_assistido', ['assistido' => $assistido, 'agenda'=> $agenda,'assistidos'=> $assistidos, 'assistido_agenda'=>$assistido_agenda]);
    }
    public function destroy($id){

        DB::table('agendas')->where('assistido_id', $id)
        ->update(['assistido_id' => null,'Status' => 0]);
        Assistido::destroy('id', $id);

        if ((Auth::user()->user_type) == 2){
            return redirect('/')->with('msg', 'Assistido deletado!');
        }
        
        elseif((Auth::user()->user_type) == 1){
            return redirect('/mediacao/agendamentos')->with('msg', 'Assistido deletado!');
        
        }
    }
    public function store(Request $req){                                                                                                                                          

            $assistido = new Assistido();

            $assistido->nome = $req->nome;
            $assistido->nasc = $req->nasc;
            $assistido->cpf = $req->cpf;
            $assistido->telefone = $req->telefone;
            $assistido->email = $req->email;

            $assistido->save();

            $assistido_agenda = new AssistidoAgenda();
            $assistido_agenda->agenda_id = $req->agenda_id;
            $assistido_agenda->assistido_id = $assistido->id;
            $assistido_agenda->nome_assistido = $assistido->nome;
        
            $assistido_agenda->save();

        $assistido_agenda = AssistidoAgenda::all();

        $agenda = Agenda::where('id',$req->agenda_id)->get();
      
    return redirect()->route('assistido.info',[$assistido->id, $agenda]);
    
    }

}
