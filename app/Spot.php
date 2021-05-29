<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Recycling_item_spot;

class Spot extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function recycling_item_spot()
    {
        return $this->hasMany('App\recycling_item_spot');
    }

}
