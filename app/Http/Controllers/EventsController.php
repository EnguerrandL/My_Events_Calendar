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


     

       $color = 'red';


       

       return view('myeventscalendar', compact('events', 'currentDate', 'color' ));
    }


   
    public function store(Request $request)
    {
       

 
            $data = request()->validate([
                'event_name' => 'bail|required|',
                'event_description' => 'bail|required',
                'event_start' => 'bail|required',
                'event_end' => 'bail|required',
            ]);

          
    
           Event::create($data);    
           
            return back()->with('addedit', 'Your event has been added !');

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
            return back()->with('addedit', 'Your event has been updated !');

    }


    public function destroy($id)
    {
        $event= Event::find($id);

        $event->delete();

        return back()->with('delete', 'Your event has been removed !');


    }
}
