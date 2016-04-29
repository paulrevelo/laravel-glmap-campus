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
    //

    /**
	 * The pagination number.
	 *
	 * @var int
	 */
	// protected $nbrPages;
	
	/**
		 * The EventRepository instance.
	 *
	 * @var App\Repositories\EventRepository
	 */
	protected $nbrPages;

	protected $event_gestion;

	public function __construct(
		EventRepository $event_gestion)
	{
		$this->event_gestion = $event_gestion;
		$this->nbrPages = 50;
	}

	public function index()
	{
		$events = Event::paginate(15);

		return view('main.events.index',compact('events'));
	}

	public function events_create_polygon()
	{
		$events = $this->event_gestion->index($this->nbrPages);

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

	public function search($id)
	{

	}
}
