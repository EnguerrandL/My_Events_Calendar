<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Event; 
use Carbon\Carbon;
use DB;




class EventsController extends Controller
{



    public static function setColorStatus(){

        $status = 'black';

        $color = Event::where('stats', 'soon')
        ->orWhere('stats', 'now')
        ->orWhere('stats', 'finish')
        ->get();


        if($color = 'soon'){

                 $status = 'green'; 

        } elseif ($color = 'now') {

                 $status = 'blue';

        } else {
                  $status = 'red';
        }


        return view('myeventcalendar', compact('color'));
    }

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
           
            return back()->with('addedit', 'Your event has been added !');

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
            return back()->with('addedit', 'Your event has been updated !');

    }


    public function destroy($id)
    {
        $event= Event::find($id);

        $event->delete();

        return back()->with('delete', 'Your event has been removed !');


    }
}
