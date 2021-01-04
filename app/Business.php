<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = ['busID', 'name_of_company', 'address', 'city', 'state', 'country', 'zipcode', 'name', 'position', 'email', 'telephone', 'mobile', 'office', 'file', 'file2', 'file3', 'maiden_name', 'parent_meet', 'accountType', 'plan', 'specialty', 'service_offered', 'created_at', 'updated_at'];

    protected $table = "business";
}

