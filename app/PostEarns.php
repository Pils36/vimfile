<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostEarns extends Model
{
    protected $fillable = ['name', 'email', 'applicable_tax', 'post_earnings', 'post_mileage', 'tax_earnings', 'start_date', 'end_date', 'created_at', 'updated_at'];

    protected $table = "postearns";
}
