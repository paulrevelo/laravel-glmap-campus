<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable = ['name', 'description', 'height', 'roofcolor', 'wallcolor', 'image', 'polygon'];
}
