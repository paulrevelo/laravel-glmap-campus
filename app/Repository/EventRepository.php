<?php

namespace App\Repository;

use App\Model\Event;

class EventRepository extends BaseRepository{

		/**
	 * Create a new BuildingRepository instance.
	 *
	 * @param  App\Models\Event $Event
	 * @return void
	 */
	public function __construct(Event $event)
	{
		$this->model = $event;
	}

	    /**
     * Create a query for Post.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function queryActiveWithUserOrderByDate()
    {
        return $this->model
			->select('id', 'name', 'description', 'location', 'schedule')
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

	public function save()
	{
		
	}

    public function search()
    {
        
    }
}
