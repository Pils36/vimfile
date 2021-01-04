<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stations extends Model
{
    protected $fillable = ['busID', 'station_name', 'station_address', 'station_phone', 'city', 'state', 'country', 'zipcode', 'role', 'specialty', 'service_offered', 'platform_request', 'created_at', 'updated_at'];

    protected $table = "stations";
}
