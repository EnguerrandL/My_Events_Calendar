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
       $events =  Event::orderBy('event_start', 'asc')->get();
     

       return view('myeventscalendar', compact('events', 'currentDate' ));
    }


   
    public function store(Request $request)
    {

            $data = request()->validate([
                'event_name' => 'bail|required',
                'event_description' => 'bail|required',
            ]);
    
           Event::create($data);    
           
            return redirect()->back();

    }

   
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
       

       $this->validate($request,[
            'event_name' => 'bail|required',
            'event_description' => 'bail|required',
        ]);
      


        $event = Event::find($id);

        $event->save();
     

       return redirect()->back();

    }


    public function destroy($id)
    {
        $event= Event::find($id);

        $event->delete();

        return redirect()->back();
    }
}
