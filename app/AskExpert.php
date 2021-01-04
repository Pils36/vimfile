<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AskExpert extends Model
{
    protected $fillable = ['name', 'email', 'post_id', 'question', 'service_type', 'image', 'state', 'created_at', 'updated_at'];

    protected $table = "askexpert";
}

