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

    public function store(Request $request){

        $dur   = $request -> dur;
        $vagas = $request -> vagas;
        $vag_h = $request -> vag_h;

        for ($i = 0; $i< $vagas; $i++ ){
        $end = $dur * $vag_h;
        strtotime(sprintf("+%d hours", $end));
        
        $event = new Event;
        
        $event->title = $request-> title;
        $event->start = $request-> start;
        $event->end   = $end;
        $event->save();
        }


        
        
        
    
        return redirect('/calendario');
    
}


}
