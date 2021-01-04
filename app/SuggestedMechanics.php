<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuggestedMechanics extends Model
{
    protected $fillable = ['station_name', 'address', 'telephone', 'discount', 'location', 'state', 'zipcode', 'country', 'created_at', 'updated_at'];

    protected $table = "suggestedmechanics";
}

