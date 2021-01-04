<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['ref_code', 'state', 'read_state', 'about', 'image_url', 'created_at', 'updated_at'];

    protected $table = "notification";
}
