<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrecord extends Model
{
    protected $fillable = ['email', 'telephone', 'parentKey', 'child_of_parent', 'no_of_vehicle', 'vehicle_nickname', 'date_added', 'make', 'model', 'vehicle_reg_no', 'city', 'state', 'country_of_reg', 'zipcode', 'purchase_type', 'year_owned_since', 'current_mileage', 'chassis_no', 'location', 'file', 'created_at', 'updated_at', 'busID'];


    protected $table = "carrecord";
}

