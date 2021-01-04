<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reminderNotify extends Model
{
    protected $fillable = ['email', 'vehicle_licence', 'service_type', 'oilchange', 'tirerotation', 'airfilter', 'inspection', 'registration', 'email1', 'email2', 'email3', 'duration', 'reminderEmail', 'dealEmail', 'newsletterEmail', 'created_at', 'updated_at'];


    protected $table = "remindernotify";
}
