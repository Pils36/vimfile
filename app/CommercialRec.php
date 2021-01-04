<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommercialRec extends Model
{
    protected $fillable = ['vehicle_licence', 'service_type', 'created_at', 'updated_at'];

    protected $table = "commercialrec";
}
