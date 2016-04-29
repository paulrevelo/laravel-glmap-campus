<?php

namespace App\Http\Controllers;

use App\Repository\EventRepository;
use App\Http\Requests;

use App\Event;
use App\Building;
use Illuminate\Http\Request;
use Session;


class EventController extends Controller
{
	protected $nbrPages;

	protected $buildings_show_events_gestion;

	public function __construct(
		EventRepository $buildings_show_events_gestion)
	{
		$this->buildings_show_events_gestion = $buildings_show_events_gestion;
		$this->nbrPages = 50;
	}

	public function index()
	{
		$events = Event::paginate(15);

		return view('main.events.index',compact('events'));
	}

	public function events_create_polygon()
	{
		$events = $this->buildings_show_events_gestion->index($this->nbrPages);

		$links = $events->render();

		return view('main.events.create', compact('events', 'links'));
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
