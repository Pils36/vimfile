<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Points extends Model
{
    protected $fillable = ['name', 'email', 'weekly_point', 'alltime_point', 'global_point', 'state', 'country', 'created_at', 'updated_at'];

    protected $table = "points";
}
