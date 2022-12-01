<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AssistidoController extends Controller
{
    public function create($id) {

        $agenda = Agenda::findOrFail($id);

        $eventOwner = User::where('id', $agent->user_id)->first()->toArray();

        return view('/cadastroassistido', ['event' => $event, 'eventOwner'=> $eventOwner]);
    }
}
