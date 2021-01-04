<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = ['busID', 'userID', 'name', 'company', 'role', 'no_of_staff_added', 'plan', 'username', 'email', 'password', 'status', 'accountType', 'created_at', 'updated_at'];

    protected $table = "vim_admin";
}
