<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessStaffs extends Model
{
    protected $fillable = ['firstname', 'lastname', 'email', 'username', 'position', 'station', 'busID', 'userType', 'created_at', 'updated_at'];

    protected $table = "business_owner_staffs";
}
