<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Calendar;
use App\Event;

class EventController extends Controller
{
    public function index()
    {
   
        $events = Event::all();
        
        return view('fullcalender', compact('events'));
    }

    public function store(Request $request)
    {
        $event = new Event;
        $event->title = $request->title;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->color = $request->color;
        $event->save();

        $events = Event::all();
        
        return response()->json(['events' => $events]);
    }

    public function ajaxUpdate(Request $request)
    {
        
        $event = Event::findOrFail($request->event_id);
        $event->title = $request->title;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->color = $request->color;
        $event->update();

        $events = Event::all();

        return response()->json(['events' => $events]);

        //return response()->json(['success'=>'Got Simple Ajax Request.']);
    }

    public function destroy(Request $request)
    {
        $event = Event::findOrFail($request->event_id);
        $event->delete();

        return response()->json(['success'=>'success']);
    }

}