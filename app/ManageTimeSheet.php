<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManageTimeSheet extends Model
{
    protected $fillable = ['busID', 'date_in', 'time_in', 'date_out', 'time_out', 'technician_name', 'technician_id', 'created_at', 'updated_at'];

    protected $table = "manage_time_sheet";
}
