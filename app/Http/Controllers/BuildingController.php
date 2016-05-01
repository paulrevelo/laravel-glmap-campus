<?php

namespace App\Http\Controllers;


use App\Http\Requests;

use App\Building;
use App\Event;
use Illuminate\Http\Request;
use Session;


class BuildingController extends Controller
{

	public function index_2()
	{

		$buildings = Building::all();

		return view('home',compact('buildings'));
	}

	public function index()
	{
		$buildings = Building::all();

		return view('main.buildings.index',compact('buildings'));
	}


	public function index2()
	{
		$buildings = Building::all();

		$events = Event::all();

		return view('home', compact('buildings', 'events'));

	}

	public function polygon_index()
	{
		$buildings = Building::all();

		$events = Event::all();

		return view('main.index', compact('buildings', 'events'));
	}


	public function index_map_editor()
	{
		$buildings = Building::all();

		$events = Event::all();

		return view('main.map-editor', compact('buildings', 'events'));
	}

	public function buildings_create_polygon()
	{
		$buildings = Building::all();

		$events = Event::all();

		return view('main.buildings.create', compact('buildings', 'events'));
	}

	public function buildings_edit_polygon()
	{
		$buildings = Building::all();

		return view('main.buildings.edit', compact('buildings'));
	}

	public function events_create_polygon()
	{
		$buildings = Building::all();

		$events = Event::all();

		return view('main.events.create', compact('buildings', 'events'));
	}

	public function buildings_edit($id)
	{
		$buildings = $this->polygon_gestion->index($this->nbrPages);
		$building = Building::findOrFail($id);

		$links = $buildings->render();

		return view('main.buildings.edit', compact('building','buildings', 'links'));
	}
	//end of dead functions


	public function create()
	{
		return view('main.buildings.create');
	}

	public function store(Request $request)
	{
	   	Building::create($request->all());

	   	//Session::flash('flash_message', 'Building added!');

		return redirect('buildings');
	}

	public function show($id)
    {
      	$building = Building::findOrFail($id);

   		return view('main.buildings.show',compact('building'));
    }

    public function edit($id)
	{
		$building = Building::findOrFail($id);

   		return view('main.buildings.edit',compact('building'));
	}	
	
	public function update($id, Request $request)
	{
        $building = Building::findOrFail($id);

        $building->update($request->all());

        //Session::flash('flash_message', 'Building updated!');

      	return redirect('buildings');
	}

	public function destroy($id)
    {
        Building::destroy($id);

        //Session::flash('flash_message', 'Building deleted!');

        return redirect('buildings');
    }

	public function searchByString(Request $request)
	{
		    // Gets the query string from our form submission 
		    $query = Request::input('search');
		    // Returns an array of articles that have the query string located somewhere within 
		    // our articles titles. Paginates them so we can break up lots of search results.
		  	$buildings = DB::table('buildings')
		  		->where('name', 'LIKE', '%' . $query . '%')
		  		->where('description', 'LIKE', '%' . $query . '%')
		  			->paginate(15);
		        
			// returns a view and passes the view the list of articles and the original query.
		    return view('main.building.index', compact('buildings', 'links', 'query'));


		 // $buildings = $query->where(function($q) use ($search) {
   //                  $q->where('name', 'like', "%$search%")
   //                          ->orWhere('description', 'like', "%$search%");
   //              })->paginate(15);
		 // $links = $buildings->render();

		 // return view('main.building.index', compact('buildings','links'));
	}

	public function jsonByID($id){
		return Building::findOrFail($id);
	}

	public function json(){
		return Building::all();
	}
	

}
