<?php

namespace App\Http\Controllers;

use App\Repository\BuildingRepository;
use App\Repository\EventRepository;
use App\Http\Requests;

use App\Building;
use Illuminate\Http\Request;
use Session;


class BuildingController extends Controller
{
    //
    /**
	 * The pagination number.
	 *
	 * @var int
	 */
	protected $nbrPages;

	protected $buildings_show_polygons_gestion;

	public function __construct(
		EventRepository $buildings_show_events_gestion,
		BuildingRepository $buildings_show_polygons_gestion)
	{
		$this->buildings_show_events_gestion = $buildings_show_events_gestion;
		$this->buildings_show_polygons_gestion = $buildings_show_polygons_gestion;
		$this->nbrPages = 50;
	}	

	public function index()
	{

		$buildings = Building::paginate(15);

		return view('main.buildings.index',compact('buildings'));
	}

	public function index_map_editor()
	{
		$buildings = $this->buildings_show_polygons_gestion->index($this->nbrPages);

		$links = $buildings->render();

		return view('main.map-editor', compact('buildings', 'links'));
	}

	public function polygon_index()
	{
		$buildings = $this->buildings_show_polygons_gestion->index($this->nbrPages);

		$links = $buildings->render();

		return view('main.index', compact('buildings', 'links'));
	}

	public function buildings_create_polygon()
	{
		$buildings = $this->buildings_show_polygons_gestion->index($this->nbrPages);

		$links = $buildings->render();

		return view('main.buildings.create', compact('buildings', 'links'));
	}

	public function buildings_edit_polygon()
	{
		$buildings = $this->buildings_show_polygons_gestion->index($this->nbrPages);

		$links = $buildings->render();

		return view('main.buildings.edit', compact('buildings', 'links'));
	}

	public function index2()
	{

		$buildings = Building::all();

		return view('home',compact('buildings'));
	}

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

	public function search($id)
	{

	}
	
}
