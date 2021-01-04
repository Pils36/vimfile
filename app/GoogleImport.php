<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoogleImport extends Model
{
    protected $fillable = ['name', 'email', 'invite_from', 'status', 'created_at', 'updated_at'];

    protected $table = "googleimport";

}

