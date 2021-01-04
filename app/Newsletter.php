<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $fillable = ['email', 'state', 'created_at', 'updated_at'];

    protected $table = "newsletter";
}
