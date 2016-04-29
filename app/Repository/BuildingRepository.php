<?php

namespace App\Repository;

use App\Building;

class BuildingRepository extends BaseRepository{

	public function __construct(Building $building)
	{
		$this->model = $building;
	}

    private function queryActiveWithUserOrderByDate()
    {
        return $this->model
			->select('id', 'name', 'description', 'height', 'roofcolor', 'wallcolor', 'polygon')
                ->latest();
    }

    public function index($n)
    {
        $query = $this->queryActiveWithUserOrderByDate();
            
        return $query->paginate($n);
    }

	public function allJSON()
	{
		$this->$building->toJSON();
	}
}
