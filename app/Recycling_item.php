<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Recycling_item_spot;
use App\Spot;

class Recycling_item extends Model
{
    public function spots()
    {
        return $this->belongsToMany(Spot::class, Recycling_item_spot::class);
    }
}
