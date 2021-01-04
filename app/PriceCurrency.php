<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceCurrency extends Model
{
    protected $fillable = ['country', 'currency', 'plan', 'monthly', 'yearly', 'plan2', 'monthly2', 'yearly2', 'plan3', 'monthly3', 'yearly3', 'plan4', 'monthly4', 'yearly4', 'plan5', 'monthly5', 'yearly5', 'plan6', 'monthly6', 'yearly6', 'created_at', 'updated_at'];

    protected $table = "pricecurrency";
}
