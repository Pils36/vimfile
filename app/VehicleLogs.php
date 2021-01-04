<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleLogs extends Model
{
    protected $fillable = ['service_type', 'post_id', 'name', 'created_at', 'updated_at'];

    protected $table = "vehiclelogs";
}
