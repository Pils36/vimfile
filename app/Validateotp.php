<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Validateotp extends Model
{
    protected $fillable = ['token', 'verification_code', 'email', 'phone_number', 'status', 'created_at', 'updated_at'];

    protected $table = "otp";
}

