<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $fillable = ['token', 'email', 'verifylink', 'state', 'created_at', 'updated_at'];

    protected $table = "passwordreset";
}
