<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function index(){

        return view('welcome');
    }
    public function create(){
        return view('novo/novo-agendamento');
    }

    public function calcular(Request $request){
        
        $dur = $_POST["dur"];
        $vagas = $_POST["vagas"];
        $vag_h = $_POST["vag_h"];

        echo "digitou $dur, $vagas, $vag_h";
        
        return redirect('novo/create');
    }

    public function store(Request $request){
        
        $event = new Event;
        
        $event->title = $request-> title;
        $event->start = $request-> start;
        $event->end   = $request-> end;

    
        $event->save();
    
        return redirect('/calendario');
    
}


}
