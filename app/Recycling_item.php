<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Recycling_item_spot;
use App\Spot;

class recycling_item extends Model
{
    public function spots()
    {
        return $this->belongsToMany('App\Spot');
    }
}
