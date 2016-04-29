<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Event;
use Illuminate\Http\Request;
use Session;


class EventController extends Controller
{

	public function index()
	{
		$events = Event::all();

		return view('main.events.index',compact('events'));
	}

	public function create()
	{
		return view('main.events.create');
	}

	public function store(Request $request)
	{

	   	Event::create($request->all());

	   	//Session::flash('flash_message', 'Event added!');

		return redirect('events');
	}

	public function show($id)
    {
      	$event = Event::findOrFail($id);

   		return view('main.events.show',compact('event'));
    }

	public function edit($id)
	{
		$event = Event::findOrFail($id);

   		return view('main.events.edit',compact('event'));
	}	
	
	public function update($id, Request $request)
	{

        $event = Event::findOrFail($id);

        $event->update($request->all());

        //Session::flash('flash_message', 'Event updated!');

      	return redirect('events');
	}

	public function destroy($id)
    {
        Event::destroy($id);

        //Session::flash('flash_message', 'Event deleted!');

        return redirect('events');
    }
}
