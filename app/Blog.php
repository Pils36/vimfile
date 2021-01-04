<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['title', 'body', 'created_at', 'updated_at'];

    protected $table = "blog";
}
