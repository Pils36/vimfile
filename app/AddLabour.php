<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddLabour extends Model
{
    protected $fillable = ['busID', 'firstname', 'lastname', 'category', 'speciality', 'email', 'phone', 'hourly_rate', 'flat_rate', 'budgeted_hours', 'actual_hours', 'labour_cost', 'total_cost', 'job_description', 'notes', 'timesheet', 'file', 'created_at', 'updated_at'];

    protected $table = "add_labour";
}

