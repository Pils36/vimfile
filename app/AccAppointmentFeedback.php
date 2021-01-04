<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccAppointmentFeedback extends Model
{
    protected $fillable = ['ref_code', 'visitation_info', 'granted_discount', 'state', 'created_at', 'updated_at'];

    protected $table = "accappointment_feedback";
}
