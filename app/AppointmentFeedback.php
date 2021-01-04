<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppointmentFeedback extends Model
{
    protected $fillable = ['ref_code', 'visitation_info', 'receive_discount', 'quality_of_service', 'created_at', 'updated_at'];

    protected $table = "appointment_feedback";
}
