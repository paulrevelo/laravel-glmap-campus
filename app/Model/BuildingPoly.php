<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BuildingPoly extends Model
{
    //
    protected $table = "building_polies";
    

    public function building()
    {
        return $this->belongsTo('App\Model\Building');
    }
}
