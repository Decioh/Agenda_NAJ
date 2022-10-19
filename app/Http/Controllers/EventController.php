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
        $start = $request-> start;
        $fim = $request -> fim;
        $end = 0;

        $aux = date('Y-m-d', strtotime($start. ' - 1 days'));

        while($start<$end){
        for ($i=0 ; $i<$vagas ; $i++){
            if($i==0){
                $aux = date('Y-m-d', strtotime($aux. ' + 1 days'));
                $start = $aux;
                $end = $start;
                $end = date('Y-m-d H:i', strtotime("+$dur minutes",strtotime($start)));
                $event = new Event;
        
                $event->title = 'Horário vago';
                $event->start = $start;
                $event->vag_h = $request-> vag_h;
                $event->end   = $end;
                $event->save();
                }
            else{
                $start = $end;   
                $end = date('Y-m-d H:i', strtotime("+$dur minutes",strtotime($start)));
                $event = new Event;
        
                $event->title = 'Horário vago';
                $event->start = $start;
                $event->vag_h = $request-> vag_h;
                $event->end   = $end;
                $event->save();
                }
            
        }
        }
        
        return redirect('/calendario');
        }

}