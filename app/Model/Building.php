<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    //
    protected $fillable = ['name', 'description', 'height', 'roofcolor', 'wallcolor', 'polygon'];

    
    // public function poly()
    // {
    //     return $this->hasOne('App\Model\BuildingPoly');
    // }
}
