<?php

namespace App\Repository;

use App\Building;

class BuildingRepository extends BaseRepository{

		/**
	 * Create a new BuildingRepository instance.
	 *
	 * @param  App\Models\Building $Building
	 * @return void
	 */
	public function __construct(Building $building)
	{
		$this->model = $building;
	}

	/**
     * Create a query for Post.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function queryActiveWithUserOrderByDate()
    {
        return $this->model
			->select('id', 'name', 'description')
                ->latest();
    }

	 /**
     * Get event collection.
     *
     * @param  int  $n
     * @return Illuminate\Support\Collection
     */
    public function index($n)
    {
        $query = $this->queryActiveWithUserOrderByDate();
            
        return $query->paginate($n);
    }

	public function all()
	{
		$this->$building;
	}

	public function saveBuilding()
	{
		
	}
}
