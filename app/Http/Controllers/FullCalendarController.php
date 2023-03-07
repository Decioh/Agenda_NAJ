<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

use App\Models\Event;

class FullCalendarController extends Controller 
{
    public function index(Request $request)
    {
    	if($request->ajax())
    	{
    		$data = Agenda::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'assistido_id', 'start', 'end']);
            return response()->json($data);
    	}
    	return view('full-calendar');
    }

    public function action(Request $request)
    {
    	if($request->ajax())
    	{
    		if($request->type == 'add')
    		{
    			$event = Agenda::create([
    				'assistido'		=>	$request->assistido,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'update')
    		{
    			$event = Agenda::find($request->id)->update([
    				'assistido'		=>	$request->assistido,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'delete')
    		{
    			$event = Agenda::find($request->id)->delete();

    			return response()->json($event);
    		}
    	}
    }

	
}
?>