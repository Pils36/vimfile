<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = ['ref_code', 'name', 'email', 'subject', 'description', 'state', 'created_at', 'updated_at'];

    protected $table = "feedbacks";
}
