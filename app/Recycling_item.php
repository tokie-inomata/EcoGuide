<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Recycling_item_spot;

class recycling_item extends Model
{
    public function recycling_item_spot()
    {
        return $this->hasMany('App\Recycling_item_spot');
    }
}
