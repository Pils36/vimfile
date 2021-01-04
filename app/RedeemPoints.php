<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RedeemPoints extends Model
{
    protected $fillable = ['ref_code', 'name', 'email', 'points', 'userType', 'status', 'created_at', 'updated_at'];

    protected $table = "redeempoint";
}
