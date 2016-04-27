<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\BuildingRepository;
use App\Repository\PolygonRepository;
use App\Http\Requests;

class BuildingController extends Controller
{
    //
    /**
	 * The pagination number.
	 *
	 * @var int
	 */
	protected $nbrPages;

	protected $building_gestion;
	protected $polygon_gestion;

	public function __construct(
		BuildingRepository $building_gestion,
		PolygonRepository $polygon_gestion)
	{
		$this->building_gestion = $building_gestion;
		$this->polygon_gestion = $polygon_gestion;
		$this->nbrPages = 50;
	}	

	public function index()
	{
		$buildings = $this->building_gestion->index($this->nbrPages);
		$links = $buildings->render();

		return view('main.buildings', compact('buildings', 'links'));
	}

	public function polygon_map_editor(){
		$polygons = $this->polygon_gestion->index($this->nbrPages);
		$links = $polygons->render();
		return view('main.map-editor', compact('polygons', 'links'));
	}

	public function polygon_index(){
		$polygons = $this->polygon_gestion->index($this->nbrPages);
		$links = $polygons->render();
		return view('main.index', compact('polygons', 'links'));
	}

	
}
