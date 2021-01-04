<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnsFromExpert extends Model
{
    protected $fillable = ['autocare', 'post_id', 'answer', 'created_at', 'updated_at'];

    protected $table = "ansfromexpert";
}

