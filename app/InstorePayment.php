<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstorePayment extends Model
{
    protected $fillable = ['transactionid', 'estimate_id', 'name', 'email', 'amount', 'station', 'technician', 'purpose', 'gateway', 'created_at', 'update_by'];

    protected $table = "instore_payment";
}
