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
        
        $event = new Event;
        
        $event->title = $request-> title;
        $event->start = $request-> start;
        $event->end   = $request-> end;

    
        $event->save();
    
        return redirect('/calendario');
    
}


}
