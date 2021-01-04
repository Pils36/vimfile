<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MinimumDiscount extends Model
{
    protected $fillable = ['discount', 'percent', 'created_at', 'updated_at'];

    protected $table = "minimum_discount";
}
