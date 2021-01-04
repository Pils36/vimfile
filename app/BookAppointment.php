<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookAppointment extends Model
{
    protected $fillable = ['busID', 'ref_code', 'station_name', 'name', 'email', 'subject', 'message', 'date_of_visit', 'service_option', 'service_type', 'current_mileage', 'state', 'accstate', 'created_at', 'updated_at'];

    protected $table = "book_appointment";
}
