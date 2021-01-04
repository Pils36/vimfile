<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempUser extends Model
{
    protected $guarded = [];

    protected $table = "temp_users";
}
