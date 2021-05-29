<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Spot;
use App\Recycling_item;

class Recycling_Item_Spot extends Model
{
    public function spot()
    {
        return $this->belongsTo('App\Spot');
    }

    public function recycling_item()
    {
        return $this->belongsTo('App\Recycling_item');
    }
}
