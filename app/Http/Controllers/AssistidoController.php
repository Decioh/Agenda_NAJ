<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Agenda;
use App\Models\Agendamento;
use App\Models\Assistido;
use Illuminate\Http\Request;

class AssistidoController extends Controller
{
    public function create($id) {

        $agenda = Agenda::findOrFail($id);

        //$eventOwner = User::where('id', $users->user_id)->first()->toArray();

    return view('/cadastroassistido', ['agenda' => $agenda/*, 'eventOwner'=> $eventOwner*/]);
    }
    public function store(Request $req){

        $assistido=Assistido::find(($req->id));
    
        $nome = $req -> nome;
        $nasc = $req -> nasc;
        $cpf = $req -> cpf;
        $email = $req -> email;
        $telefone = $req -> telefone;
        $info = $req -> info;

        $assistido = new Assistido;

        $assistido->nome = $nome;
        $assistido->nasc = $nasc;
        $assistido->cpf = $cpf;
        $assistido->email = $email;
        $assistido->telefone = $telefone;
        $assistido->info = $info;

        $assistido->save();     

    return redirect('/mediacao/agendamentos')->with('msg', 'Agendamento concluído!');
    }
}
