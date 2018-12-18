<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Parkable extends Model
{
    protected $fillable = ['plate','type'];

    function lot()
    {
        return $this->belongsToMany(Lot::class);
    }

}