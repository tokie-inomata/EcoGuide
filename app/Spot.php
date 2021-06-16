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

    public function recycling_items()
    {
        return $this->belongsToMany('App\Recycling_item','App\Recycling_item_spot');
    }

    public function getData()
    {
        return $this->prefecture. $this->city. $this->house_number;
    }

}
