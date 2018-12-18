<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;


class ParkableLot extends Pivot
{
    protected $fillable = ['parkable_id','lot_id'];
}