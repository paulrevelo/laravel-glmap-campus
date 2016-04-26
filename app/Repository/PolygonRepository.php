<?php

namespace App\Repository;

use App\Model\BuildingPoly;

class PolygonRepository extends BaseRepository{

		/**
	 * Create a new BuildingRepository instance.
	 *
	 * @param  App\Models\Building $Building
	 * @return void
	 */
	public function __construct(BuildingPoly $polygon)
	{
		$this->model = $polygon;
	}

	/**
     * Create a query for Post.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function queryActiveWithUserOrderByDate()
    {
        return $this->model
			->select('id', 'height', 'roofcolor', 'wallcolor', 'polygon')
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

	public function allJSON()
	{
		$this->$polygon->toJSON();
	}

	public function update()
	{
		
	}
}
