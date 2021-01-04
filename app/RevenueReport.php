<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevenueReport extends Model
{
    protected $fillable = ['name', 'email', 'start_date', 'end_date', 'avg_rev_month', 'tot_rev', 'created_at', 'updated_at'];

    protected $table = "revenuereport";
}
