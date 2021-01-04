<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrepareEstimate extends Model
{
    protected $fillable = ['post_id', 'estimate_id', 'email', 'ref_code', 'state', 'est_prepared', 'created_at', 'updated_at'];

    protected $table = "prepareestimate";
}
