<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event; 
use Carbon\Carbon;

class EventsController extends Controller
{

    public function index()
    {
       $currentDate = new carbon; 
       $events =  Event::all();
      
     

       return view('myeventscalendar', compact('events', 'currentDate' ));
    }


   
    public function store(Request $request)
    {

            $data = request()->validate([
                'event_name' => 'bail|required',
                'event_description' => 'bail|required',
            ]);

          
    
           Event::create($data);    
           
            return back();

    }

   

    
    public function update(Request $request)
    {

        $data = array(
            'event_name' => $request->event_name,
            'event_description' => $request->event_description,
            'event_start' =>  new carbon,
            'event_end' => new carbon,
        );

        Event::findOrFail($request->id)->update($data);

            // dd($event); exit;
            return back();

    }


    public function destroy($id)
    {
        $event= Event::find($id);

        $event->delete();

        return back();
    }
}
