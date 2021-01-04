<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noemail extends Model
{
    protected $fillable = ['station', 'address', 'telephone', 'created_at', 'updated_at'];

    protected $table = "no_email";
}
