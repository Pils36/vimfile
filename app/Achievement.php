<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = ['name', 'email', 'weekly_rank', 'global_rank', 'created_at', 'updated_at'];

    protected $table = "achievement";
}
