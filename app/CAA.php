<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CAA extends Model
{
    protected $fillable = ["city", "name_of_company", "address", "telephone", "email", "zipcode", "state"];

    protected $table = "caa_table";
}
