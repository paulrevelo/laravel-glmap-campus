<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    //
    protected $table = 'buildings';

    
    public function poly()
    {
        return $this->hasOne('App\Model\BuildingPoly');
    }
}
