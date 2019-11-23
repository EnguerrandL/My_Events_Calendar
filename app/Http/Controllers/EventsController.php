<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event; 
use Carbon\Carbon;
use DB;




class EventsController extends Controller
{

    public function index()
    {

        
    //    $currentUserName = Auth::user()->name;
       $currentDate = new carbon; 
       $events =  Event::all();


       $color = 'blue'; 


       return view('myeventscalendar', compact('events', 'currentDate', 'color' ));
    }


   
    public function store(Request $request)
    {
       

   


            $data = request()->validate([
                'event_name' => 'bail|required|',
                'event_description' => 'bail|required',
                'event_start' => 'bail|',
                'event_end' => 'bail|',
            ]);

          
    
           Event::create($data);    
           
            return back();

    }



    
    public function update(Request $request)
    {
        
  

        $data = array(
            'event_name' => $request->event_name,
            'event_description' => $request->event_description,
            'event_start' =>  $request->event_start,
            'event_end' => $request->event_end,
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
