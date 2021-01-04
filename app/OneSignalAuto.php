<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OneSignalAuto extends Model
{
    protected $fillable = ['heading', 'content', 'category', 'state', 'created_at', 'updated_at'];

    protected $table = "onesignalauto";
}
