<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['ref_code', 'post_id', 'technician', 'station_name', 'rating', 'comment', 'created_at', 'updated_at'];

    protected $table = "rating";
}

