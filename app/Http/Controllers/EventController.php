<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\EventRepository;
use App\Http\Requests;

class EventController extends Controller
{
    //

    /**
	 * The pagination number.
	 *
	 * @var int
	 */
	protected $nbrPages;
	
	/**
		 * The EventRepository instance.
	 *
	 * @var App\Repositories\EventRepository
	 */
	protected $event_gestion;

	public function __construct(
		EventRepository $event_gestion)
	{
		$this->event_gestion = $event_gestion;
		$this->nbrPages = 2;
	}	

	public function index()
	{
		$events = $this->event_gestion->index($this->nbrPages);
		$links = $events->render();

		return view('main.events', compact('events', 'links'));
	}

	public function create()
	{

	}

	public function update()
	{

	}

	public function store()
	{

	}

	public function edit()
	{

	}

	public function search()
	{

	}
}
