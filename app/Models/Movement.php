<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Movement extends Model
{
    protected $fillable = ['parkable_id','lot_id','action'];
}