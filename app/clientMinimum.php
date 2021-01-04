<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clientMinimum extends Model
{
    protected $fillable = ['busID', 'discount', 'percent', 'created_at', 'updated_at'];

    protected $table = "clientminimum";
}
